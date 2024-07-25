<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\RestaurantTable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ReservationFactory extends Factory
{

    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'restaurant_table_id' => RestaurantTable::factory(),
            'reservation_time' => $this->faker->dateTimeBetween('now', '+1 week'),

        ];
    }
}
