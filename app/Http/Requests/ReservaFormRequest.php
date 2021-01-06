<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservaFormRequest extends FormRequest
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
            // 'FechReserva' => 'required|date_format:Y-m-d H:i:s',
            // 'FechEntrada' => 'date_format:d-m-Y H:i:s',
            'FechSalida' => 'after_or_equal:FechReserva',
            'CostoAlojamiento' => 'numeric',
            'Observacion' => 'max:150',
            'Estado' => 'required',
            'IdCliente' => 'required',
            'Num_Hab' => 'required',
            // 'IdUsuario' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'Num_Hab.required' => 'Debe seleccionar una Habitación.',
        ];
    }
}
