<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomLine = \App\Models\Line::all()->random();
        $randomVehicle = \App\Models\Vehicle::where('TypeId', $randomLine->TypeId)->inRandomOrder()->first();
        return [
            'LineId' => $randomLine,
            'VehicleId' => $randomVehicle,
            'DriverId' => '9c0d1e2f-3a4b-5c6d-7e8f-9a0b1c2d3e4f',
            'DepartureDate' => $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s'),
            'IsReverse' => $this->faker->boolean
        ];
    }
}
