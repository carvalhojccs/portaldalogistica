<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTelefoneFormRequest extends FormRequest
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
            'numero'    => ['required','min:10'],
        ];
    }
    
    public function messages() 
    {
        return [
            'numero.required'   => 'Este campo é obrigatório',
            'numero.min'        => 'Número de telefone incompleto',
        ];
    }
}
