<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Car
 */
class Car extends Model
{
    use HasFactory;

    /**
     * Atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'model',         // Nombre o modelo del auto
        'description',   // Descripción del auto (opcional si se usa)
        'price',         // Precio del auto
        'kilometraje',   // Kilometraje del auto
        'brand_id'       // ID de la marca asociada
    ];

    /**
     * Relación muchos a uno: un auto pertenece a una marca.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
