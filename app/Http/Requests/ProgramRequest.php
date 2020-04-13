<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramRequest extends FormRequest
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
            'name'        => 'required',
            'slogan'      => 'required',
            'presenter'   => 'required',
            'category'    => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => "Campo Obrigatório",
            'slogan.required'      => "Campo Obrigatório",
            'presenter.required'   => "Campo Obrigatório",
            'category.required'    => "Campo Obrigatório",
            'description.required' => "Campo Obrigatório",
        ];
    }
}
