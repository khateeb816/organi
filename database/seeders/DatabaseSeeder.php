<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin and User
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$12$MlGFbrD.vhL/kygnJNWhte/i9II8V5Xm6BsopKW9RnJ3YLUwCT09O',
            'role' => 'admin',
            'brand_id' => 1,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => '$2y$12$MlGFbrD.vhL/kygnJNWhte/i9II8V5Xm6BsopKW9RnJ3YLUwCT09O',
            'role' => 'customer',
        ]);

        // Create 10 Categories
        \App\Models\Catagory::factory(10)->create();

        // Create 10 Brands
        \App\Models\Brand::factory(10)->create();

        // Create 40 Products with varying states
        $states = ['featured', 'latest', 'top_rated', 'review'];

        foreach ($states as $state) {
            \App\Models\Product::factory(10)->create([
                'state' => $state, // Dynamically set the state
            ]);
        }
    }
}
