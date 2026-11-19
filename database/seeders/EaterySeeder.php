<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Dish;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    public function run(): void
    {
        // Find the district for your personalized eatery.
        $poblacion = District::where('name', 'Poblacion')->firstOrFail();

        // Create your eatery by hand, not through a factory.
        $name = 'Carinderia ni Dimatulac';

        $myEatery = Eatery::create([
            'district_id' => $poblacion->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);

        // Attach exactly the two required features.
        $featureIds = Feature::whereIn('name', [
            'Suki ni Dimatulac',
            'Budget Meal',
        ])->pluck('id')->all();

        $myEatery->features()->sync($featureIds);

        // Create your personalized business permit.
        $myEatery->permit()->create([
            'permit_no' => 'DVO-2026-0807',
            'expires_on' => '2027-08-07',
        ]);

        // Create exactly three dishes for your eatery.
        $myEatery->dishes()->createMany([
            [
                'name' => 'Tinolang Manok',
                'price' => 85.00,
                'is_bestseller' => true,
            ],
            [
                'name' => 'Kinilaw na Tuna',
                'price' => 120.00,
                'is_bestseller' => false,
            ],
            [
                'name' => 'Durian Shake',
                'price' => 75.00,
                'is_bestseller' => false,
            ],
        ]);

        // Get the six existing district IDs.
        $districtIds = District::pluck('id')->all();

        // Create fourteen additional eateries.
        for ($i = 0; $i < 14; $i++) {

            // Exactly three factory eateries are closed.
            $factory = Eatery::factory();

            if ($i < 3) {
                $factory = $factory->closed();
            }

            // Assign a real district before saving.
            $eatery = $factory->create([
                'district_id' => fake()->randomElement($districtIds),
            ]);

            // Generate one permit per eatery.
            $permit = Permit::factory()->make();

            $eatery->permit()->create([
                'permit_no' => $permit->permit_no,

                // Make the first factory permit expired.
                'expires_on' => $i === 0
                    ? now()->subMonth()->toDateString()
                    : $permit->expires_on,
            ]);

            // Generate between two and five dishes.
            $dishCount = rand(2, 5);

            for ($j = 0; $j < $dishCount; $j++) {
                $dish = Dish::factory()->make();

                $eatery->dishes()->create([
                    'name' => $dish->name,
                    'price' => $dish->price,
                    'is_bestseller' => $dish->is_bestseller,
                ]);
            }

            // Attach one to three random features.
            $randomFeatures = Feature::inRandomOrder()
                ->limit(rand(1, 3))
                ->pluck('id')
                ->all();

            $eatery->features()->attach($randomFeatures);
        }
    }
}
