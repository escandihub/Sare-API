<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenciaRequest extends FormRequest
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
            'Licencias_Emitidas' => ['required'],
            'Empleos_Generados' => ['required'],
            'Inversion_Generada' => ['required'],
            'No_Asesorias' => ['required'],
            'Mes' => ['required'],
            'Year' => ['required'],
        ];
    }
}
