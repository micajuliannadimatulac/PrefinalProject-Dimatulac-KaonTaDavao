<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        // Create the six required Davao districts.
        $districts = [
            'Poblacion',
            'Talomo',
            'Agdao',
            'Buhangin',
            'Toril',
            'Bunawan',
        ];

        foreach ($districts as $name) {
            District::create([
                'name' => $name,
            ]);
        }
    }
}
