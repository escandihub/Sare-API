<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenciaEmpresaRequest extends FormRequest
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
            'Empresa' => ['required'],
            'Giro' => ['required'],
            'Inversion' => ['required'],
            'No_Empleo' => ['required'],
            
            // id
            'EnlaceMunicipal' => ['required','exists:catalogoenlaces,Enlace_Municipal'],

            'Mes' => ['required'],
            'Year' => ['required'],
            'IdUsuario' => ['required'],
            'FechaCreacion' => ['required'],
            'FechaActualizacion' => ['required'],
            'MesConcluido' => ['required'],
            'Rango' => ['required'],
        ];
    }
}
