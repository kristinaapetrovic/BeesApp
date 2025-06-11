<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikacija extends Model
{
    use HasFactory;
    protected $fillable = ['tekst', 'datum_slanja', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
