<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsumoFormRequest extends FormRequest
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
            'Cantidad'=>'required',
            'Total'=>'required',
          
            'IdProducto'=>'required',
            'IdReserva'=>'required',


        ];
    }
    // public function messages()
    // {
    //     return [
    //     'Denominacion.required' => 'la Denominación es un campo requerido',
    //     'Denominacion.max' => 'El tamaño del texto no debe se mayor a 40 caracteres',
    //     ];
    // }
}
