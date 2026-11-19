<?php

namespace Database\Factories;

use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Eatery>
 */
class EateryFactory extends Factory
{
    protected $model = Eatery::class;

    public function definition(): array
    {
        // Generate a unique name and matching URL slug.
        $name = fake()->unique()->company() . ' Eatery';

        return [
            'district_id' => null,
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => fake()->streetAddress() . ', Davao City',
            'price_range' => fake()->randomElement([
                'budget',
                'mid',
                'splurge',
            ]),
            'specialty' => fake()->randomElement([
                'Adobong Manok',
                'Tinolang Manok',
                'Pork Sinigang',
                'Kinilaw na Tuna',
                'Chicken Inasal',
                'Beef Caldereta',
            ]),
            'is_open' => true,
        ];
    }

    // Generate a closed eatery.
    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_open' => false,
        ]);
    }
}
