<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('UserType')->insert([
            ['Description' => 'Ridic'],
            ['Description' => 'Dispecer'],
            ['Description' => 'Technik'],
            ['Description' => 'Spravce'],
            ['Description' => 'Admin'],
        ]);

        DB::table('ReportState')->insert([
            ['Description' => 'Reported'],
            ['Description' => 'Rejected'],
            ['Description' => 'Waiting for maintenance'],
            ['Description' => 'Finished'],
        ]);

        DB::table('ReportType')->insert([
            ['Description' => 'Malfuction'],
            ['Description' => 'Maintenance'],
        ]);

        DB::table('VehicleState')->insert([
            ['Description' => 'Operational'],
            ['Description' => 'Non-operational'],
        ]);

        DB::table('VehicleType')->insert([
            ['Description' => 'Tramvaj', 'Icon' => 'mdi-tram'],
            ['Description' => 'Trolejbus', 'Icon' => 'mdi-bus-electric'],
            ['Description' => 'Autobus', 'Icon' => 'mdi-bus'],
            ['Description' => 'Metro', 'Icon' => 'mdi-subway'],
            ['Description' => 'Lod', 'Icon' => 'mdi-ferry'],
            ['Description' => 'Vlak', 'Icon' => 'mdi-train'],
            ['Description' => 'Letadlo', 'Icon' => 'mdi-airplane'],
        ]);
    }
}
