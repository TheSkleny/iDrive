<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = ['Skoda', 'BMW', 'Mercedes-Benz', 'Audi', 'Volkswagen'];
        $randomBrand = $brands[array_rand($brands)];
        return [
            'Name' => fake()->name(),
            'Brand' => $randomBrand,
            'LastMaintenance' => now(),
            'Capacity' => fake()->numberBetween(1, 200),
            'SpeedLimit' => fake()->numberBetween(1, 120),
            'LicensePlate' => fake()->numberBetween(1, 9) . chr(rand(65, 90)) . fake()->numberBetween(1, 99999),
            'TypeId' => fake()->numberBetween(1, 5),
            'StateId' => fake()->numberBetween(1, 2),
        ];
    }
}
