<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        // Create the required eatery features.
        $features = [
            'Suki ni Dimatulac',
            'Budget Meal',
            'Halal',
            'Open 24 Hours',
            'Aircon',
            'Free Wi-Fi',
        ];

        foreach ($features as $name) {
            Feature::create([
                'name' => $name,
            ]);
        }
    }
}
