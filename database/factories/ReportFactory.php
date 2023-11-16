<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomVehicle = \App\Models\Vehicle::all()->random();
        $randomDate = new DateTime();
        $randomDate->setTimestamp(rand(strtotime('2023-01-01'), time()));
        $randomMaintenanceDate = new DateTime();
        $randomMaintenanceDate->setTimestamp(rand($randomDate->getTimestamp(), time()));
        return [
            'ReportDate' => $randomDate,
            'DriverId' => '9c0d1e2f-3a4b-5c6d-7e8f-9a0b1c2d3e4f',
            'DriverDescription' => $this->faker->text,
            'VehicleId' => $randomVehicle,
            'TechnicianId' => '1a2b3c4d-5e6f-7a8b-9c0d-1e2f3a4b5c6d',
            'TechnicianDescription' => $this->faker->text,
            'MaintenanceDate' => $randomMaintenanceDate,
            'StateId' => fake()->numberBetween(1, 4),
            'TypeId' => fake()->numberBetween(1, 2),
        ];
    }
}
