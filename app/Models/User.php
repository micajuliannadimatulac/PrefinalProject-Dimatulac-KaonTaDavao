<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Fields allowed when creating a user.
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Hide sensitive values when converting to arrays.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast attributes to their correct PHP types.
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // A user can write many eatery reviews.
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
