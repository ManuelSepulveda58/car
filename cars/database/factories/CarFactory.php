<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    public function definition()
    {
        return [
            'brand_id' => Brand::factory(),
            'model' => $this->faker->word,
            'year' => $this->faker->year,
            'price' => $this->faker->numberBetween(10000, 100000)
        ];
    }
}