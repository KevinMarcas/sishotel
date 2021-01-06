<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HabitacionFormRequest extends FormRequest
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
            'Num_Hab'=>'required|numeric|unique:habitacion,Num_Hab,'. $this->Num_Hab_a .',Num_Hab',
            'Descripcion' => 'required | max:200',
            'Estado' => 'required | max:40',
            'Precio' => 'required | numeric',
            'IdTipoHabitacion' => 'required' ,
            'IdNivel' => 'required' ,
        ];
    }
    public function messages()
    {
        return [
        'Num_Hab.required' => 'Ingrese el Nro de Habitación',
        'Num_Hab.unique' => 'Ya existe una Habitación con el mismo número.',
        'Num_Hab.numeric' => 'El valor del campo "Nro Habitación" debe ser un numero.',
        'Descripcion.required' => 'Debe realizar una breve descripción de la Habitación.',
        'Descricion.max' => 'El tamaño de la descripción no debe se mayor a 200 caracteres',
        'Estado.max' => 'El tamaño del texto no debe se mayor a 40 caracteres',
        'Precio.required' => 'Ingrese el Precio de la Habitación.',
        'Precio.numeric' => 'El precio debe ser un valor numerico',
        ];
    }
}
