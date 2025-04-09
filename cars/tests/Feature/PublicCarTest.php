<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicCarTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_ver_pagina_principal()
    {
        $response = $this->get('/');
        $response->assertStatus(200)
                 ->assertViewIs('home');
    }

    public function test_puede_listar_autos_publicos()
    {
        $brand = Brand::factory()->create();
        Car::factory()->count(5)->create(['brand_id' => $brand->id]);

        $response = $this->get('/cars');

        $response->assertStatus(200)
                 ->assertViewIs('index')
                 ->assertViewHas('cars', function($cars) {
                     return $cars->count() === 5;
                 });
    }

    public function test_muestra_relacion_brand_en_listado()
    {
        $brand = Brand::factory()->create(['name' => 'Toyota']);
        $car = Car::factory()->create(['brand_id' => $brand->id]);

        $response = $this->get('/cars');
        
        $response->assertSee('Toyota');
    }
}