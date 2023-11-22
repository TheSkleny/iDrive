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
            'Id' => '9aacc18c-55ae-4b9c-9d6c-27cef04cc81f',
            'Name' => 'JosefTram',
            'ImageUri' => 'https://i.pinimg.com/564x/3d/0b/9c/3d0b9c8b92352e73c7e74d4133010a17.jpg',
            'TypeId' => '1',
        ]);

        Vehicle::factory()->create([
            'Id' => '9aacc18c-7c8d-4790-9303-8dc8862b1b53',
            'Name' => 'VilemTrol',
            'TypeId' => '2',
        ]);

        Vehicle::factory()->create([
            'Id' => '9aacc18c-a73e-446a-9db5-582955250bad',
            'Name' => 'PetrBus',
            'TypeId' => '3',
        ]);

        Vehicle::factory(5)->create();
    }
}
