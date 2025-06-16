<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class Kosnica extends Model
{
    use HasFactory;
    protected $fillable = ['oznaka', 'tip', 'status', 'pcelinjak_id'];
    public static $status = ['AKTIVNA', 'NEAKTIVNA'];

    public function pcelinjak(): BelongsTo
    {
        return $this->belongsTo(Pcelinjak::class);
    }

    public function drustvos(): HasMany
    {
        return $this->hasMany(Drustvo::class);
    }

    public function scopeFilter(Builder|QueryBuilder $query, array $filteri, User $user): Builder|QueryBuilder
    {
        return $query
            ->whereHas('pcelinjak', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->when($filteri['tip'] ?? null, function ($query, $tip) {
                $query->where('tip', 'like', '%' . $tip . '%');
            })->when($filteri['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })->when($filteri['pcelinjak'] ?? null, function ($query, $pcelinjak) {
                $query->where('pcelinjak_id', $pcelinjak);
            });
    }
}
