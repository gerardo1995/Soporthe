<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return ['domain'=>'required',
                'municipality'=>'required',
                'address'=>'required'];
    }

    public function messages()
    {
        return [
            'domain.required'=>"El campo 'Departamento' es obligatorio",
            'municipality.required'=>"El campo 'Municipio' es obligatorio",
            'address.required'=>"El campo 'Dirección' es obligatorio"
        ];
    }
}
