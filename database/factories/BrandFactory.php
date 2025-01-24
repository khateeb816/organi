<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company, // Generate a random brand name
            'email' => $this->faker->unique()->companyEmail, // Generate a unique email
            'logo' => 'backendAssets/images/brand/brand.jpeg', // Default logo path
            'address' => $this->faker->address, // Generate a random address
            'number' => $this->faker->phoneNumber, // Generate a random phone number
            'allowed_categories' => json_encode([$this->faker->numberBetween(1, 10)]), // Random category IDs
            'status' => 'active', // Default status
            'percent_charge' => $this->faker->numberBetween(5, 20), // Random percentage charge
            'created_at' => now(),
        ];
    }
}
