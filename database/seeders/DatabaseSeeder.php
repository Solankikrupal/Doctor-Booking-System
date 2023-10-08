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
            'name' => 'Frank will',
            'email' => 'frwill@example.com',
            'password' => '123456789',
            'role' => 'patient',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Dr Joe',
            'email' => 'docjoe@example.com',
            'password' => '123456789',
            'role' => 'doctor',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Natalie Port',
            'email' => 'napa@example.com',
            'password' => '123456789',
            'role' => 'patient',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Dr Smith',
            'email' => 'drsmith@example.com',
            'password' => '123456789',
            'role' => 'doctor',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Jimmy k',
            'email' => 'jk@example.com',
            'password' => '123456789',
            'role' => 'patient',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Dr Malhotra',
            'email' => 'drma@example.com',
            'password' => '123456789',
            'role' => 'doctor',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Peter pa',
            'email' => 'pp@example.com',
            'password' => '123456789',
            'role' => 'patient',
        ]);
    }
}
