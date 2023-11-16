<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::factory()->create([
            'Name' => 'JosefTram',
            'ImageUri' => 'https://i.pinimg.com/564x/3d/0b/9c/3d0b9c8b92352e73c7e74d4133010a17.jpg',
            'TypeId' => '1',
        ]);

        Vehicle::factory()->create([
            'Name' => 'VilemTrol',
            'TypeId' => '2',
        ]);

        Vehicle::factory()->create([
            'Name' => 'PetrBus',
            'TypeId' => '3',
        ]);

        Vehicle::factory(5)->create();
    }
}
