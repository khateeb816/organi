<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(50, 500),
            'total_items' => $this->faker->numberBetween(1, 100),
            'images' => '["backendAssets\/images\/products\/6799f5aac7a59_pexels-madebymath-90946.jpg"]',
            'color' => json_encode([$this->faker->safeColorName]),
            'size' => json_encode([$this->faker->randomElement(['S', 'M', 'L', 'XL'])]),
            'catagory_id' => $this->faker->numberBetween(1, 10),
            'brand_id' => $this->faker->numberBetween(1, 10),
            'status' => 'active',
            'state' => 'featured', // Default state
        ];
    }
}
