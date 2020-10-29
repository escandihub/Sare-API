<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnlaceRequest extends FormRequest
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
                'Enlace_Municipal' => ['required','unique:catalogoenlaces,Enlace_Municipal']
            ];
        } else if ($this->getMethod() === 'PUT') {            
            return [
                'Enlace_Municipal' => ['required', 'unique:catalogoenlaces,Enlace_Municipal,' . $this->enlace->Id]
            ];
        }
    }
}
