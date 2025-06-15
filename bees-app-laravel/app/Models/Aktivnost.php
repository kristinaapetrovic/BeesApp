<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class Aktivnost extends Model 
{
    use HasFactory; 
    protected $fillable = ['naziv', 'opis', 'tip', 'pocetak', 'kraj', 'status', 'drustvo_id', 'user_id', 'notifikacija_poslata'];
    public static $tip=['SEZONSKA','NESEZONSKA'];
    public static $status=['PLANIRANA', 'U TOKU', 'ZAVRSENA'];

    public function drustvo(): BelongsTo
    {
        return $this->belongsTo(Drustvo::class);
    }

    public function komentars():HasMany{
        return $this->hasMany(Komentar::class);
    }

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function sugestijas():HasMany{
        return $this->hasMany(Sugestija::class);
    }

    public function scopeFilter(Builder|QueryBuilder $query, array $filteri, User $user): Builder|QueryBuilder{
        return $query->where('user_id', $user->id)->when($filteri['pocetak'] ?? null, function ($query, $pocetak){
            $query->whereMonth('pocetak', $pocetak);
        })->when($filteri['tip'] ?? null, function ($query, $tip){
            $query->where('tip', $tip);
        })->when($filteri['status'] ?? null, function ($query, $status){
            $query->where('status', $status);
        })->when($filteri['drustvo'] ?? null, function ($query, $drustvo){
            $query->where('drustvo_id', $drustvo);
        });
    }
}
