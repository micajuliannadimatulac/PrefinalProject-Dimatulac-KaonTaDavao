<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create your personalized reviewer.
        User::create([
            'name' => 'Mica Dimatulac',
            'email' => 'dimatulac@kaonta.test',
            'password' => Hash::make('kaonta2026'),
        ]);

        // Create Tita Dimatulac.
        User::create([
            'name' => 'Tita Dimatulac',
            'email' => 'tita.dimatulac@kaonta.test',
            'password' => Hash::make('kaonta2026'),
        ]);

        // Add ten more sample reviewers.
        User::factory()->count(10)->create();
    }
}
