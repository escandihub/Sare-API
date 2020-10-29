<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BitacoraRequest extends FormRequest
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
        if ($this->getMethod() === 'POST') {
            return [
                'TipoMovimiento' => ['required', 'unique:catalogobitacora,TipoMovimiento'],
            ];
        } else if ($this->getMethod() === 'PUT') {
            return [
                'TipoMovimiento' => ['required', 'unique:catalogobitacora,TipoMovimiento,' . $this->bitacora->IdTipo],
            ];
        }
    }
}
