<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drustvo extends Model
{
    use HasFactory;
    protected $fillable = ['kosnica_id', 'matica_starost', 'jacina', 'datum_formiranja'];
    public static $jacina = ['jako', 'srednje', 'slabo'];

    

    public function aktivnosts(): HasMany
    {
        return $this->hasMany(Aktivnost::class);
    }
    
}
