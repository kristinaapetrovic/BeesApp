<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aktivnost extends Model
{
    use HasFactory;
    protected $fillable = ['naziv', 'opis', 'tip', 'pocetak', 'kraj', 'status', 'drustvo_id', 'user_id'];
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
}
