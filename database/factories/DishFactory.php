<?php

namespace Database\Factories;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dish>
 */
class DishFactory extends Factory
{
    protected $model = Dish::class;

    public function definition(): array
    {
        return [
            // The seeder will assign the dish to an existing eatery.
            'eatery_id' => null,

            // Choose a realistic Filipino dish.
            'name' => fake()->randomElement([
                'Chicken Adobo',
                'Pork Sinigang',
                'Tinolang Manok',
                'Beef Caldereta',
                'Chicken Inasal',
                'Kinilaw na Tuna',
                'Pancit Canton',
                'Lechon Kawali',
                'Grilled Bangus',
                'Bicol Express',
            ]),

            // Store prices with two decimal places.
            'price' => fake()->randomFloat(2, 50, 250),

            // Some dishes are bestsellers.
            'is_bestseller' => fake()->boolean(30),
        ];
    }
}
