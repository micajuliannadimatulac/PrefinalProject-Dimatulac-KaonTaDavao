<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            // The seeder will assign the review to an existing eatery.
            'eatery_id' => null,
            // The seeder will assign an existing reviewer.
            'user_id' => null,

            // Ratings range from 1 to 5.
            'rating' => fake()->numberBetween(1, 5),

            // Generate review text longer than 10 characters.
            'body' => fake()->randomElement([
                'Lami kaayo ang pagkaon! Balik ko diri.',
                'Sulit ang presyo ug daghan ang serving.',
                'Friendly ang staff ug limpyo ang lugar.',
                'Affordable meals and delicious dishes.',
                'Nice place for a quick and tasty lunch.',
                'Fresh ang food ug paspas ang service.',
            ]),
        ];
    }
}
