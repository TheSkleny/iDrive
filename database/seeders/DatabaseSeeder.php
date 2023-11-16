<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TypeStateSeeder::class,
            UserSeeder::class,
            StopSeeder::class,
            VehicleSeeder::class,
            LineSeeder::class,
            LineStopSeeder::class,
            TimeBetweenStopsSeeder::class,
            ReportSeeder::class,
            LinkSeeder::class,
        ]);
    }
}
