<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Komentar extends Model
{
    use HasFactory;
    protected $fillable = ['sadrzaj', 'datum', 'aktivnost_id', 'user_id'];

    public function aktivnost(): BelongsTo
    {
        return $this->belongsTo(Aktivnost::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
