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
            'DriverId' => '5', // in testing profiles driver is seeded with id 5
            'DepartureTime' => (new \DateTime())->setTime(rand(0, 23), rand(0, 59), 0)->format('H:i:s'),
            'IsReverse' => $this->faker->boolean
        ];
    }
}
