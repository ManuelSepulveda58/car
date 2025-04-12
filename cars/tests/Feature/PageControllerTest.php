<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;




    /** @test */
    public function catalog_filtra_por_modelo()
    {
        Car::factory()->create(['model' => 'Corolla']);
        Car::factory()->create(['model' => 'Civic']);

        $response = $this->get('/cars?model=Corolla');

        $response->assertStatus(200)
                 ->assertSee('Corolla')
                 ->assertDontSee('Civic');
    }




    /** @test */
    public function catalog_filtra_por_rango_de_precio()
    {
        Car::factory()->create(['model' => 'Barato', 'price' => 10000]);
        Car::factory()->create(['model' => 'Caro', 'price' => 50000]);

        $response = $this->get('/cars?price_min=5000&price_max=20000');

        $response->assertStatus(200)
                 ->assertSee('Barato')
                 ->assertDontSee('Caro');
    }

    /** @test */
    public function catalog_filtra_por_kilometraje()
    {
        Car::factory()->create(['model' => 'PocoUso', 'kilometraje' => 10000]);
        Car::factory()->create(['model' => 'MuchoUso', 'kilometraje' => 100000]);

        $response = $this->get('/cars?km_min=5000&km_max=50000');

        $response->assertStatus(200)
                 ->assertSee('PocoUso')
                 ->assertDontSee('MuchoUso');
    }

    /** @test */
    public function admin_login_muestra_formulario()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200)
                 ->assertViewIs('admin.login');
    }

    /** @test */
    public function process_admin_login_redirige_con_credenciales_correctas()
    {
        $response = $this->post('/admin/login', ['password' => '1234']);
        $response->assertRedirect(route('admin.cars.index'));
        $this->assertTrue(session()->has('admin_authenticated'));
    }

    /** @test */
    public function process_admin_login_muestra_error_con_credenciales_incorrectas()
    {
        $response = $this->post('/admin/login', ['password' => 'incorrecto']);
        $response->assertRedirect()
                 ->assertSessionHas('error');
        $this->assertFalse(session()->has('admin_authenticated'));
    }
}