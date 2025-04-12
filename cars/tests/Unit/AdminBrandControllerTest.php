<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Brand;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminBrandControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_brand_with_image()
    {
        Storage::fake('public');

        $response = $this->post(route('admin.brands.store'), [
            'name' => 'Toyota',
            'imagen' => UploadedFile::fake()->image('toyota.jpg')
        ]);

        $response->assertRedirect(route('admin.brands.index'));
        $this->assertDatabaseHas('brands', ['name' => 'Toyota']);
        $storedImage = Brand::first()->imagen;

        $this->assertTrue(Storage::disk('public')->exists($storedImage));
    }

    /** @test */
    public function it_can_update_a_brand_and_replace_image()
    {
        Storage::fake('public');

        $brand = Brand::factory()->create([
            'imagen' => UploadedFile::fake()->image('old.jpg')->store('brands', 'public')
        ]);

        $response = $this->put(route('admin.brands.update', $brand), [
            'name' => 'Toyota Updated',
            'imagen' => UploadedFile::fake()->image('new.jpg')
        ]);

        $response->assertRedirect(route('admin.brands.index'));
        $this->assertDatabaseHas('brands', ['name' => 'Toyota Updated']);
    }

    /** @test */
    public function it_can_delete_a_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->delete(route('admin.brands.destroy', $brand));

        $response->assertRedirect(route('admin.brands.index'));
        $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
    }
}
