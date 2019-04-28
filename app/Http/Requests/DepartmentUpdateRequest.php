<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'unique:departments,name,' . $this->departamento
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "El campo 'Nombre' es obligatorio",
            'name.unique' => 'Este departamento ya fue agregado'
        ];
    }
}
