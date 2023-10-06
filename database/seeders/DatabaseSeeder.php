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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Doctor',
            'email' => 'doctor@example.com',
            'password' => '123456789',
            'role' => 'doctor',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Patient',
            'email' => 'patient@example.com',
            'password' => '123456789',
            'role' => 'patient',
        ]);
    }
}
