<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Stop')->insert([
            ['Id' => '3f0c8d0d-8d8b-4a9d-8536-505056a973aa', 'Name' => 'Hlavní nádraží'],
            ['Id' => '6b9f617d-3f82-40ac-b1f1-8a9e5a14f8b2', 'Name' => 'Autobusové nádraží'],
            ['Id' => '7c6f14d3-2c4b-4c5b-8b38-87d4b2a3a8a0', 'Name' => 'Envelopa'],
            ['Id' => '9d8e7724-2f75-4bfc-95f2-4183c8f68825', 'Name' => 'BigOne'],
            ['Id' => '2f4a8d7e-1958-4f6b-9c9d-2bb9a4e54c67', 'Name' => 'Jednota'],
            ['Id' => '1a2b3c4d-5e6f-7a8b-9c0d-1e2f3a4b5c6d', 'Name' => 'Písařov, točna'],
            ['Id' => '0e1f2a3b-4c5d-6e7f-8a9b-0c1d2e3f4a5b', 'Name' => 'Smilov'],
            ['Id' => '9c0d1e2f-3a4b-5c6d-7e8f-9a0b1c2d3e4f', 'Name' => 'Letňany'],
            ['Id' => '8b9a0c1d-2e3f-4a5b-6c7d-8e9f0a1b2c3d', 'Name' => 'Kosmonautů'],
            ['Id' => '7a8b9c0d-1e2f-3a4b-5c6d-7e8f9a0b1c2d', 'Name' => 'Václavská'],
            ['Id' => '6c7d8e9f-0a1b-2c3d-4e5f-6a7b8c9d0e1f', 'Name' => 'Kartouzská'],
        ]);
    }
}
