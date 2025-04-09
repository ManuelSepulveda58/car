<?php

namespace Tests\Unit;

use App\Models\Car;
use Tests\TestCase;

class CarTest extends TestCase
{
    /** @test */
    public function it_calculates_final_price_with_tax()
    {
        $car = Car::factory()->create([
            'price' => 10000,
            'tax_rate' => 0.19 // 19%
        ]);

        $this->assertEquals(11900, $car->final_price);
    }
}