<?php

namespace App\Repositories;

use App\Models\Vehicle;

class VehicleRepository extends BaseRepository
{
    /**
     * Create a new VehicleRepository instance.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return void
     */
    public function __construct(Vehicle $vehicle)
    {
        $this->model = $vehicle;
    }

    /**
     * Create a new vehicle.
     *
     * @param  array<string, mixed>  $vehicle
     * @return \App\Models\Vehicle
     */
    public function create(array $vehicle): Vehicle
    {
        return $this->model->create($vehicle);
    }

    /**
     * Update a vehicle.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @param  array<string, mixed>  $data
     * @return void
     */
    public function update(Vehicle $vehicle, array $data): void
    {
        $vehicle->update($data);
    }

    /**
     * Delete a vehicle.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return void
     */
    public function delete(Vehicle $vehicle): void
    {
        $vehicle->delete();
    }
}