<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required|unique:users,email,NULL,id,deleted_at,NULL',
            'phone'=>'required',
            'password' => 'required',
            'place_id' => 'required',
            'role_id' => 'required',
            'department_id' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => "El campo 'Nombre' es obligatorio",
            'email.required' => "El campo 'Correo' es obligatorio". $this->tag,
            'email.unique' => 'Este correo ya esta en uso',
            'phone.required' => "El campo 'Teléfono' es obligatorio",
            'pass.required' => "El campo 'Contraseña' es obligatorio",
            'place_id.required' => 'El usuario debe tener un lugar asignado',
            'role_id.required' => 'El usuario debe tener un rol asignado',
            'department_id.required' => 'El usuario debe tener un departamento asignado'
        ];
    }
}
