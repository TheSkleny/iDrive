<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LineStopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('LineStop')->insert([
            // 12
            ['LineId' => '123e4567-e89b-12d3-a456-426614174000', 'StopId' => '3f0c8d0d-8d8b-4a9d-8536-505056a973aa', 'Order' => '1'],
            ['LineId' => '123e4567-e89b-12d3-a456-426614174000', 'StopId' => '6c7d8e9f-0a1b-2c3d-4e5f-6a7b8c9d0e1f', 'Order' => '2'],
            ['LineId' => '123e4567-e89b-12d3-a456-426614174000', 'StopId' => '7c6f14d3-2c4b-4c5b-8b38-87d4b2a3a8a0', 'Order' => '3'],
            ['LineId' => '123e4567-e89b-12d3-a456-426614174000', 'StopId' => '9d8e7724-2f75-4bfc-95f2-4183c8f68825', 'Order' => '4'],
            ['LineId' => '123e4567-e89b-12d3-a456-426614174000', 'StopId' => '7a8b9c0d-1e2f-3a4b-5c6d-7e8f9a0b1c2d', 'Order' => '5'],
            ['LineId' => '123e4567-e89b-12d3-a456-426614174000', 'StopId' => '2f4a8d7e-1958-4f6b-9c9d-2bb9a4e54c67', 'Order' => '6'],
            ['LineId' => '123e4567-e89b-12d3-a456-426614174000', 'StopId' => '8b9a0c1d-2e3f-4a5b-6c7d-8e9f0a1b2c3d', 'Order' => '7'],
            ['LineId' => '123e4567-e89b-12d3-a456-426614174000', 'StopId' => '6b9f617d-3f82-40ac-b1f1-8a9e5a14f8b2', 'Order' => '8'],

            // 67
            ['LineId' => '987e6543-e21b-23d4-b657-426614174000', 'StopId' => '3f0c8d0d-8d8b-4a9d-8536-505056a973aa', 'Order' => '1'],
            ['LineId' => '987e6543-e21b-23d4-b657-426614174000', 'StopId' => '6c7d8e9f-0a1b-2c3d-4e5f-6a7b8c9d0e1f', 'Order' => '2'],
            ['LineId' => '987e6543-e21b-23d4-b657-426614174000', 'StopId' => '7c6f14d3-2c4b-4c5b-8b38-87d4b2a3a8a0', 'Order' => '3'],
            ['LineId' => '987e6543-e21b-23d4-b657-426614174000', 'StopId' => '1a2b3c4d-5e6f-7a8b-9c0d-1e2f3a4b5c6d', 'Order' => '4'],
            ['LineId' => '987e6543-e21b-23d4-b657-426614174000', 'StopId' => '0e1f2a3b-4c5d-6e7f-8a9b-0c1d2e3f4a5b', 'Order' => '5'],
            ['LineId' => '987e6543-e21b-23d4-b657-426614174000', 'StopId' => '9c0d1e2f-3a4b-5c6d-7e8f-9a0b1c2d3e4f', 'Order' => '6'],
            ['LineId' => '987e6543-e21b-23d4-b657-426614174000', 'StopId' => '6b9f617d-3f82-40ac-b1f1-8a9e5a14f8b2', 'Order' => '7'],
        
        ]);
    }
}
