<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@idrive.com',
            'password' => 'admin',
            'type_id' => '5',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'spravce',
            'email' => 'spravce@idrive.com',
            'password' => 'spravce',
            'type_id' => '4',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'technik',
            'email' => 'technik@idrive.com',
            'password' => 'technik',
            'type_id' => '3',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'dispecer',
            'email' => 'dispecer@idrive.com',
            'password' => 'dispecer',
            'type_id' => '2',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'ridic',
            'email' => 'ridic@idrive.com',
            'password' => 'ridic',
            'type_id' => '1',
        ]);
    }
}
