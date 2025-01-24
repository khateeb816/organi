<?php

namespace Database\Factories;

use App\Models\Catagory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatagoryFactory extends Factory
{
    protected $model = Catagory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Generate a random category name
            'description' => $this->faker->sentence, // Generate a random description
            'created_at' => now(),
        ];
    }
}
