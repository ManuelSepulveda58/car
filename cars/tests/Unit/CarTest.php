<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Car;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_car_belongs_to_a_brand()
    {
        $brand = Brand::factory()->create();
        $car = Car::factory()->create([
            'brand_id' => $brand->id
        ]);

        $this->assertInstanceOf(Brand::class, $car->brand);
    }
}
