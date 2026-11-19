<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'eatery_id',
        'user_id',
        'rating',
        'body',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
        ];
    }

    // A review belongs to one eatery.
    public function eatery(): BelongsTo
    {
        return $this->belongsTo(Eatery::class);
    }

    // A review is written by one user.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
