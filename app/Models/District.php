<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class District extends Model
{
    use HasFactory;
    
    // Fields that can be mass-assigned.
    protected $fillable = [
        'name',
    ];

    // One district contains many eateries.
    public function eateries(): HasMany
    {
        return $this->hasMany(Eatery::class);
    }

    // Access reviews through the district's eateries.
    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(
            Review::class,
            Eatery::class
        );
    }
}
