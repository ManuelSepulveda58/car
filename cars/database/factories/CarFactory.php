<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
// database/factories/CarFactory.php
    public function definition()
    {
        return [
            'brand_id' => Brand::factory(),
            'model' => $this->faker->word,
            'price' => $this->faker->numberBetween(10000, 100000),
            'kilometraje' => $this->faker->numberBetween(0, 200000)
        ];
    }
}