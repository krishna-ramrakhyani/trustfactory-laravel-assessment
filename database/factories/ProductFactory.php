<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'price' => $this->faker->randomFloat(2, 100, 5000),
            'stock_quantity' => $this->faker->numberBetween(0, 50),
        ];
    }
}

