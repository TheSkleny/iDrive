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
            'DriverId' => '5', // in testing profiles driver is seeded with id 5
            'DriverDescription' => $this->faker->text,
            'VehicleId' => $randomVehicle,
            'TechnicianId' => '3', // in testing profiles technician is seeded with id 3
            'TechnicianDescription' => $this->faker->text,
            'MaintenanceDate' => $randomMaintenanceDate,
            'StateId' => fake()->numberBetween(1, 4),
            'TypeId' => fake()->numberBetween(1, 2),
        ];
    }
}
