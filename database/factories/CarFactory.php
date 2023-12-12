<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'img_src' => $this->faker->word,
            'daily_price' => $this->faker->randomNumber(2),
            'status' => $this->faker->boolean,
        ];
    }
}
