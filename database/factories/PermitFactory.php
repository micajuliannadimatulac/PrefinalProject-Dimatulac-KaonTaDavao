<?php

namespace Database\Factories;

use App\Models\Permit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Permit>
 */
class PermitFactory extends Factory
{
    protected $model = Permit::class;

    public function definition(): array
    {
        return [
            // The seeder will create the permit through an eatery.
            'eatery_id' => null,

            // Generate a unique permit number.
            'permit_no' => fake()->unique()->numerify(
                'DVO-2026-#####'
            ),

            // Most generated permits are valid.
            'expires_on' => now()->addYear()->toDateString(),
        ];
    }

    // Generate an expired permit for testing.
    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'expires_on' => now()->subMonth()->toDateString(),
        ]);
    }
}
