<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class Pcelinjak extends Model
{
    use HasFactory;
    protected $fillable=['naziv', 'lokacija', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kosnicas():HasMany{
        return $this->hasMany(Kosnica::class);
    }

    public function scopeFilter(Builder|QueryBuilder $query, array $filteri, User $user): Builder|QueryBuilder{
        return $query->where('user_id', $user->id)
        ->when($filteri['lokacija'] ?? null, function ($query, $lokacija){
            $query->where('lokacija', $lokacija);
        });
    }
}
