<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case'PUT':

                if (is_null($this->input('password', null))) {
                    $this->offsetUnset('password');
                }

                return [
                    'name'  => 'required|min:3',
                    "email" => "required|unique:users,email,".auth()->user()->id,
                ];
        }
    }
}
