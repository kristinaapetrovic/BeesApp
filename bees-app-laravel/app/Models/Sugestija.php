<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sugestija extends Model
{
    use HasFactory;

    protected $fillable = ['poruka', 'datum_kreiranja', 'user_id', 'aktivnost_id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function aktivnost():BelongsTo
    {
        return $this->belongsTo(Aktivnost::class);
    }
}
