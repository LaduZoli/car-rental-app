<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;
use App\Models\Car;
use App\Models\Booking;
use App\Http\Controllers\CarController;


class PublicTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /*
    public function testShowAvailableCars()
    {
        $car1 = Car::factory()->create(['status' => true]);
        $car2 = Car::factory()->create(['status' => true]);
        $bookedCar = Car::factory()->create(['status' => true]);
        $booking = Booking::factory()->create([
            'car_id' => $bookedCar->id,
            'start_date' => now()->subDays(2),
            'end_date' => now()->addDays(2),
        ]);

        $response = $this->get('/list-of-cars', [
            'start_date' => now()->subDays(5)->format('Y-m-d'),
            'end_date' => now()->subDays(3)->format('Y-m-d'),
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('public/list-of-cars');
        $response->assertViewHas('availableCars');

        $response->assertDontSeeText($bookedCar->model);

        $response->assertSeeText($car1->model);
        $response->assertSeeText($car2->model);
    }
    */
    public function testStore()
    {
        $userData = [
            'name' => 'Teszt User',
            'email' => 'teszt@example.com',
            'address' => 'Teszt cím',
            'phone' => '123456789',
            'days' => 3,
            'amount' => 150,
        ];

        $car = Factory::factoryForModel(\App\Car::class)->create(); // Az \App\Car model helyére tedd az aktuális Car model namespace-ét
        $bookingData = [
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->addDays(3)->format('Y-m-d'),
            'car_id' => $car->id,
        ];

        $response = $this->post('/car/booking/submit', array_merge($userData, $bookingData));

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Sikeres foglalás']);
    }
}
