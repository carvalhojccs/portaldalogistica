<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLocalFormRequest extends FormRequest
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
        $id = $this->segment(3);
        return [
            'nome'  => ['required','min:3','max:200',"unique:locais,nome,{$id},id"],
            'sigla'  => ['required','min:3','max:7',"unique:locais,sigla,{$id},id"],
        ];
    }
    
    public function messages() 
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min'      => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max'      => 'O campo nome deve ter no máximo 200 caracteres',
            'nome.unique'   => 'O nome inserido já está cadastrado',
            'sigla.required' => 'O campo sigla é obrigatório',
            'sigla.min'      => 'O campo sigla deve ter no mínimo 3 caracteres',
            'sigla.max'      => 'O campo sigla deve ter no máximo 7 caracteres',
            'sigla.unique'   => 'A sigla inserida já está cadastrada',
        ];
    }
}
