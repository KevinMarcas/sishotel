<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NivelFormRequest extends FormRequest
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
            'Denominacion'=>'required|max:40|unique:nivel,Denominacion,'. $this->IdNivel .',IdNivel'
        ];
    }
    public function messages()
    {
        return [
            'Denominacion.unique' => 'Ya existe un registro con ese nombre.',
            'Denominacion.required' => 'Tiene que ingresar la denominación del Nivel de Habitación.',
            'Denominacion.max' => 'El tamaño del texto no debe se mayor a 40 caracteres',
        ];
    }

}
