<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskTypeUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return ['name'=>'required|unique:task_types,name,'.$this->actividade];
    }


    public function messages()
    {
        return [
            'name.required' => 'Nombre es obligatorio',
            'name.unique' => 'Este tipo de actividad ya fue agregado'
        ];
    }
}
