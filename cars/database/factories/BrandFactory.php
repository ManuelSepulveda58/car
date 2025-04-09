<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarApiTest extends TestCase
{
    use RefreshDatabase; // Limpia la base de datos entre pruebas

    /** @test */
    public function puede_listar_todos_los_autos()
    {
        Car::factory()->count(3)->create();

        $response = $this->getJson('/api/cars');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'brand_id', 'model', 'year', 'price', 'created_at', 'updated_at']
                 ]);
    }

    /** @test */
    public function puede_crear_un_auto()
    {
        $brand = Brand::factory()->create();

        $response = $this->postJson('/api/cars', [
            'brand_id' => $brand->id,
            'model' => 'Corolla',
            'year' => 2023,
            'price' => 25000
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'model' => 'Corolla',
                     'year' => 2023,
                     'price' => 25000
                 ]);

        $this->assertDatabaseHas('cars', ['model' => 'Corolla']);
    }

    /** @test */
    public function validacion_de_campos_requeridos()
    {
        $response = $this->postJson('/api/cars', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['brand_id', 'model', 'year', 'price']);
    }

    /** @test */
    public function puede_mostrar_un_auto_especifico()
    {
        $car = Car::factory()->create();

        $response = $this->getJson("/api/cars/{$car->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $car->id,
                     'model' => $car->model
                 ]);
    }

    /** @test */
    public function puede_actualizar_un_auto()
    {
        $car = Car::factory()->create(['price' => 20000]);

        $response = $this->putJson("/api/cars/{$car->id}", [
            'price' => 22000
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'price' => 22000
                 ]);

        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'price' => 22000
        ]);
    }

    /** @test */
    public function puede_eliminar_un_auto()
    {
        $car = Car::factory()->create();

        $response = $this->deleteJson("/api/cars/{$car->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }
}