<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Car;
use App\Models\Booking;

use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }

    /*
    public function testCreateCar()
    {
        Storage::fake('public_img');

        $response = $this->post('/car-create', [
            'name' => 'Test Car',
            'daily_price' => 100,
            'img_src' => UploadedFile::fake()->image('test.jpg'),
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('cars', [
            'name' => 'Test Car',
            'daily_price' => 100,
        ]);

        $car = Car::where('name', 'Test Car')->first();

        Storage::disk('public_img')->assertExists($car->img_src);

        $response->assertSessionHas('success', 'Az autó sikeresen felvéve.');
    }
    */
    public function testIndex()
    {
        $booking = Booking::factory()->create();

        $response = $this->get('/admin');

        $response->assertStatus(200);

        $response->assertViewIs('admin.dashboard');

        $response->assertViewHas('bookings');

        $response->assertViewHas('bookings', function ($viewBookings) use ($booking) {
            return $viewBookings->contains($booking);
        });
    }
}
