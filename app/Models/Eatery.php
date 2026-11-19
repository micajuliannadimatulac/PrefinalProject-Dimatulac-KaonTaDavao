<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Eatery extends Model
{
    // Fields allowed when creating or updating an eatery.
    protected $fillable = [
        'district_id',
        'name',
        'slug',
        'address',
        'price_range',
        'specialty',
        'is_open',
    ];

    // Convert database values into PHP types.
    protected function casts(): array
    {
        return [
            'is_open' => 'boolean',
        ];
    }

    // Use the slug instead of ID in eatery URLs.
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Each eatery belongs to one district.
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    // Each eatery has one business permit.
    public function permit(): HasOne
    {
        return $this->hasOne(Permit::class);
    }

    // Each eatery can offer multiple dishes.
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

    // Each eatery can receive multiple reviews.
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Eateries and features share a pivot table.
    public function features(): BelongsToMany
    {
        return $this->belongsToMany(
            Feature::class,
            'eatery_feature'
        );
    }
}
