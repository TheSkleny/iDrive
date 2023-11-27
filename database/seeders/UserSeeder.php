<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UserTypeEnum;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'Id' => '123e4567-e89b-12d3-a456-426614174000',
            'name' => 'admin',
            'email' => 'admin@idrive.com',
            'password' => 'admin',
            'type_id' => UserTypeEnum::ADMIN,
        ]);

        \App\Models\User::factory()->create([
            'Id' => '987e6543-e21b-23d4-b657-426614174000',
            'name' => 'spravce',
            'email' => 'spravce@idrive.com',
            'password' => 'spravce',
            'type_id' => UserTypeEnum::MANAGER,
        ]);

        \App\Models\User::factory()->create([
            'Id' => '1a2b3c4d-5e6f-7a8b-9c0d-1e2f3a4b5c6d',
            'name' => 'technik',
            'email' => 'technik@idrive.com',
            'password' => 'technik',
            'type_id' => UserTypeEnum::TECHNICIAN,
        ]);

        \App\Models\User::factory()->create([
            'Id' => '0e1f2a3b-4c5d-6e7f-8a9b-0c1d2e3f4a5b',
            'name' => 'dispecer',
            'email' => 'dispecer@idrive.com',
            'password' => 'dispecer',
            'type_id' => UserTypeEnum::DISPATCHER,
        ]);

        \App\Models\User::factory()->create([
            'Id' => '9c0d1e2f-3a4b-5c6d-7e8f-9a0b1c2d3e4f',
            'name' => 'ridic',
            'email' => 'ridic@idrive.com',
            'password' => 'ridic',
            'type_id' => UserTypeEnum::DRIVER,
        ]);

        \App\Models\User::factory()->create([
            'Id' => '9ab6b6e4-8bb4-4340-814e-22d59f0dd48c',
            'name' => 'uzivatel',
            'email' => 'uzivatel@idrive.com',
            'password' => 'uzivatel',
            'type_id' => UserTypeEnum::REGISTERED,
        ]);
    }
}
