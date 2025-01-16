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
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$12$MlGFbrD.vhL/kygnJNWhte/i9II8V5Xm6BsopKW9RnJ3YLUwCT09O',
            'role' => 'admin',
        ]);
    }
}
