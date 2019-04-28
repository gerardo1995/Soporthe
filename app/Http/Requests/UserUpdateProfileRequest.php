<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
         return [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$this->id.',id,deleted_at,NULL',
            'phone'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El campo 'Nombre' es obligatorio",
            'email.required' => "El campo 'Correo' es obligatorio". $this->tag,
            'email.unique' => 'Este correo ya esta en uso',
            'phone.required' => "El campo 'Teléfono' es obligatorio",
        ];
    }
}
