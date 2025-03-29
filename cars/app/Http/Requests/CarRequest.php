<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'model' => 'required|string|max:30',
            'description' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'kilometraje' => 'required|numeric|min:0',
            'brand_id' => 'required|exists:brands,id'
        ];
        
    }

    public function messages()
    {
        return [
            'model.required' => 'El modelo es obligatorio.',
            'model.max' => 'El modelo no puede tener más de 30 caracteres.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'kilometraje.required' => 'El kilometraje es obligatorio.',
            'kilometraje.numeric' => 'El kilometraje debe ser un número entero.',
            'kilometraje.min' => 'El kilometraje no puede ser negativo.',
            'brand_id.required' => 'La marca es obligatoria.',
            'brand_id.exists' => 'La marca seleccionada no es válida.'
        ];
    }
}
