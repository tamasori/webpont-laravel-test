<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeatherInformation>
 */
class WeatherInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'measured_at' => $this->faker->dateTime(),
            'city_id' => City::factory()->create()->getKey(),
            'temperature' => $this->faker->randomFloat(2,-20,40),
            'pressure' => $this->faker->numberBetween(900,1200),
            'humidity' => $this->faker->numberBetween(10,90),
            'min_temperature' => $this->faker->randomFloat(2,-20,40),
            'max_temperature' => $this->faker->randomFloat(2,-20,40),
        ];
    }
}
