<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
                'file' => 'required',
            ];
        }else if ($this->getMethod() === 'PUT') {            
            return [
                'file' => 'required',
                // 'file' => ['required', 'unique:catalogoenlaces,Enlace_Municipal,' . $this->enlace->Id]
            ];
        }
    }
}
