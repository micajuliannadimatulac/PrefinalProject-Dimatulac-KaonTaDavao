<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Find your personalized eatery and reviewers.
        $myEatery = Eatery::where(
            'slug',
            'carinderia-ni-dimatulac'
        )->firstOrFail();

        $mica = User::where(
            'email',
            'dimatulac@kaonta.test'
        )->firstOrFail();

        $tita = User::where(
            'email',
            'tita.dimatulac@kaonta.test'
        )->firstOrFail();

        // Required review by Tita Dimatulac.
        $myEatery->reviews()->create([
            'user_id' => $tita->id,
            'rating' => 5,
            'body' => 'Lami kaayo! Balik-balikan ni Tita Dimatulac.',
        ]);

        // Add two more reviews to your eatery.
        $myEatery->reviews()->create([
            'user_id' => $mica->id,
            'rating' => 5,
            'body' => 'Lami ang Tinolang Manok ug sulit ang presyo!',
        ]);

        $otherReviewer = User::whereNotIn('id', [
            $mica->id,
            $tita->id,
        ])->firstOrFail();

        $myEatery->reviews()->create([
            'user_id' => $otherReviewer->id,
            'rating' => 4,
            'body' => 'Fresh ang pagkaon ug maayo ang serbisyo.',
        ]);

        // Use only existing users for factory reviews.
        $userIds = User::pluck('id')->all();

        // Find all factory eateries, excluding yours.
        $eateries = Eatery::where(
            'id',
            '!=',
            $myEatery->id
        )->get();

        foreach ($eateries as $eatery) {

            // Closed eateries must have no reviews.
            if (!$eatery->is_open) {
                continue;
            }

            // Each open eatery receives zero to six reviews.
            $reviewCount = rand(0, 6);

            for ($i = 0; $i < $reviewCount; $i++) {
                $review = Review::factory()->make();

                // Create through the eatery relationship.
                $eatery->reviews()->create([
                    'user_id' => fake()->randomElement($userIds),
                    'rating' => $review->rating,
                    'body' => $review->body,
                ]);
            }
        }
    }
}
