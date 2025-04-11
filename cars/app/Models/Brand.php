<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Brand
 */
class Brand extends Model
{
    use HasFactory;

    /**
     * Atributos que se pueden asignar masivamente (mass assignment).
     */
    protected $fillable = [
        'name',     // Nombre de la marca
        'imagen'    // Ruta de la imagen de la marca 
    ];
    
    /**
     * Relación uno a muchos: una marca puede tener muchos autos.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
