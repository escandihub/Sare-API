<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoRequest extends FormRequest
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
        if($this->getMethod() === 'POST'){
            return [
                'Grupo' => ['required','unique:catalogogrupos,Grupo'],
                'Descripcion' => ['required'],
                'Status' => ['required','numeric','min:1','max:2'],
            ];
        } else if($this->getMethod() === 'PUT'){
            return [
                'Grupo' => ['required','unique:catalogogrupos,Grupo,'.$this->grupo->Id],
                'Descripcion' => ['required'],
                'Status' => ['required','numeric','min:1','max:2'],
            ];
        }
    }
}
