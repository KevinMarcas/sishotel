<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoEditFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'NombProducto'=>'required|max:40|unique:producto,NombProducto,'. $this->IdProducto .',IdProducto',
        'Precio' => 'required | numeric'     ,
        'Descripcion' => 'max:50' ,
        'IdCategoria' => 'required' ,
        'Imagen' => 'mimes:jpeg,bmp,png',
        ];
    }
    public function messages()
    {
        return [
        'NombProducto.unique' => 'Ya existe un registro con el mismo Nombre.',
        'NombProducto.required' => 'Tiene que ingresar el nombre del Producto',
        'NombProducto.max' => 'El tamaño del texto no debe se mayor a 40 caracteres',
        'Precio.required' => 'El Precio es un campo requerido',
        'Precio.numeric' => 'El Precio debe ser un valor numerico',
        'Descripcion.max' => 'El tamaño del texto no debe se mayor a 40 caracteres',
        'Imagen.mimes:jpeg,bmp,png' => 'La Imagen debe ser un valor jpeg,bmp,png ',
        ];
    }
}
