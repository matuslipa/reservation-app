<?php

namespace Tests\Unit;

use App\Models\Reservation;
use App\Models\RestaurantTable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_create_reservation(): void
    {
        $user = User::factory()->create();
        $table = RestaurantTable::factory()->create();
        $response = $this->actingAs($user)->post('/reservations', [
            'restaurant_table_id' => $table->id,
            'reservation_time' => now()->addDay()->format('Y-m-d H:i:s'),
        ]);

        $response->assertRedirect('/reservations');
        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'restaurant_table_id' => $table->id,
            'reservation_time' => now()->addDay()->format('Y-m-d H:i:s'),
        ]);
    }

    #[Test]
    public function user_cannot_create_duplicate_reservation(): void
    {
        $user = User::factory()->create();
        $table = RestaurantTable::factory()->create();
        $reservationTime = now()->addDay()->format('Y-m-d H:i:s');

        Reservation::factory()->create([
            'user_id' => $user->id,
            'restaurant_table_id' => $table->id,
            'reservation_time' => $reservationTime,
        ]);

        $response = $this->actingAs($user)->post('/reservations', [
            'restaurant_table_id' => $table->id,
            'reservation_time' => $reservationTime,
        ]);

        $response->assertSessionHasErrors();
    }

    #[Test]
    public function user_can_view_their_reservations(): void
    {
        $user = User::factory()->create();
        $table = RestaurantTable::factory()->create();

        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'restaurant_table_id' => $table->id,
            'reservation_time' => now()->addDay()->format('Y-m-d H:i:s'),
        ]);

        $response = $this->actingAs($user)->get('/reservations');

        $response->assertStatus(200);
        $response->assertSeeText($reservation->reservation_time);
        $response->assertSeeText( $table->id);
    }

    #[Test]
    public function unauthenticated_user_cannot_create_reservation(): void
    {
        $table = RestaurantTable::factory()->create();

        $response = $this->post('/reservations', [
            'restaurant_table_id' => $table->id,
            'reservation_time' => now()->addDay()->format('Y-m-d H:i:s'),
        ]);

        $response->assertRedirect('/login');
    }
}
