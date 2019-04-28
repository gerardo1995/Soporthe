<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
                    'description'=>'required',
                    'code'=>'unique:tasks,code'
               ];
    }


    public function messages()
    {
        return [
            'description.required' => "El campo 'Descripción' es obligatorio",
            'code.unique' => 'Ha ocurrido un error. Intentelo mas tarde.'
        ];
    }
}
