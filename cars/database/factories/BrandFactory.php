<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'imagen' => null, // o puedes generar una imagen falsa si deseas
        ];
    }
}
