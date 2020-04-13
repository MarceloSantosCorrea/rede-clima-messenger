<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $this->merge(['status' => in_array($this->input('status', null), [1, 'on']) ? 'active' : 'disabled']);
        switch ($this->method()) {
            case 'POST':

                return [
                    'name'     => 'required|min:3',
                    'email'    => 'required|unique:users,email',
                    'password' => 'required|min:6',
                ];

            case'PUT':

                if (is_null($this->input('password', null))) {
                    $this->offsetUnset('password');
                }

                $user = $this->route('uid');

                $id = is_object($user) ? $user->id : $user;

                return [
                    'name'  => 'required|min:3',
                    "email" => "required|unique:users,email,{$id},uid",
                ];
        }
    }
}
