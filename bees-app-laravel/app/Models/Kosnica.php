<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
