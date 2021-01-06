<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoHabitacionFormRequest extends FormRequest
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
            'Denominacion'=>'required|max:40|unique:tipohabitacion,Denominacion,'. $this->IdTipoHabitacion .',IdTipoHabitacion',
            'Descripcion' => 'max:40',
        ];
    }
    public function messages()
    {
        return [
        'Denominacion.unique' => 'Ya existe un registro con la misma denominación.',
        'Denominacion.required' => 'Debe ingresar el nombre del Tipo de Habitación.',
        'Denominacion.max' => 'El tamaño del texto no debe se mayor a 40 caracteres',
        'Descripcion.max' => 'El tamaño del texto no debe se mayor a 40 caracteres',
        ];
    }

}
