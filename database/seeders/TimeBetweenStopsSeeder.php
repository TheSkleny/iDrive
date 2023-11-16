<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeBetweenStopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('TimeBetweenStops')->insert([
            // 12
            ['FirstStopId' => '3f0c8d0d-8d8b-4a9d-8536-505056a973aa', 'SecondStopId' => '6c7d8e9f-0a1b-2c3d-4e5f-6a7b8c9d0e1f', 'TimeBetweenStops' => '10'],
            ['FirstStopId' => '6c7d8e9f-0a1b-2c3d-4e5f-6a7b8c9d0e1f', 'SecondStopId' => '7c6f14d3-2c4b-4c5b-8b38-87d4b2a3a8a0', 'TimeBetweenStops' => '5'],
            ['FirstStopId' => '7c6f14d3-2c4b-4c5b-8b38-87d4b2a3a8a0', 'SecondStopId' => '9d8e7724-2f75-4bfc-95f2-4183c8f68825', 'TimeBetweenStops' => '4'],
            ['FirstStopId' => '9d8e7724-2f75-4bfc-95f2-4183c8f68825', 'SecondStopId' => '7a8b9c0d-1e2f-3a4b-5c6d-7e8f9a0b1c2d', 'TimeBetweenStops' => '2'],
            ['FirstStopId' => '7a8b9c0d-1e2f-3a4b-5c6d-7e8f9a0b1c2d', 'SecondStopId' => '2f4a8d7e-1958-4f6b-9c9d-2bb9a4e54c67', 'TimeBetweenStops' => '8'],
            ['FirstStopId' => '2f4a8d7e-1958-4f6b-9c9d-2bb9a4e54c67', 'SecondStopId' => '8b9a0c1d-2e3f-4a5b-6c7d-8e9f0a1b2c3d', 'TimeBetweenStops' => '3'],
            ['FirstStopId' => '8b9a0c1d-2e3f-4a5b-6c7d-8e9f0a1b2c3d', 'SecondStopId' => '6b9f617d-3f82-40ac-b1f1-8a9e5a14f8b2', 'TimeBetweenStops' => '3'],

            // 67
            ['FirstStopId' => '7c6f14d3-2c4b-4c5b-8b38-87d4b2a3a8a0', 'SecondStopId' => '1a2b3c4d-5e6f-7a8b-9c0d-1e2f3a4b5c6d', 'TimeBetweenStops' => '3'],
            ['FirstStopId' => '1a2b3c4d-5e6f-7a8b-9c0d-1e2f3a4b5c6d', 'SecondStopId' => '0e1f2a3b-4c5d-6e7f-8a9b-0c1d2e3f4a5b', 'TimeBetweenStops' => '5'],
            ['FirstStopId' => '0e1f2a3b-4c5d-6e7f-8a9b-0c1d2e3f4a5b', 'SecondStopId' => '9c0d1e2f-3a4b-5c6d-7e8f-9a0b1c2d3e4f', 'TimeBetweenStops' => '10'],
            ['FirstStopId' => '9c0d1e2f-3a4b-5c6d-7e8f-9a0b1c2d3e4f', 'SecondStopId' => '6b9f617d-3f82-40ac-b1f1-8a9e5a14f8b2', 'TimeBetweenStops' => '2'],
        ]);
    }
}
