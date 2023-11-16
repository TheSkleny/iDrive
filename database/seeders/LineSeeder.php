<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Line')->insert([
            ['Id' => '123e4567-e89b-12d3-a456-426614174000', 'Name' => '12', 'TypeId' => '1'],
            ['Id' => '987e6543-e21b-23d4-b657-426614174000', 'Name' => '67', 'TypeId' => '3'],
        ]);
    }
}
