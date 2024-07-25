<?php

namespace Database\Seeders;

use App\Models\RestaurantTable;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        RestaurantTable::factory()->create([
            'name' => fake()->name(),
            'seats' => fake()->numberBetween(2,10),
        ]);
        RestaurantTable::factory()->create([
            'name' => 'Table 1',
            'seats' => fake()->numberBetween(2,10),
        ]);
        RestaurantTable::factory()->create([
            'name' => 'Table 2',
            'seats' => fake()->numberBetween(2,10),
        ]);
    }
}
