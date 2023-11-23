<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\VehicleStateEnum;
use App\Enums\VehicleTypeEnum;

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
            'TypeId' => fake()->randomElement(VehicleTypeEnum::cases()),
            'StateId' => fake()->randomElement(VehicleStateEnum::cases()),
        ];
    }
}
