<?php

namespace App\Http\Requests\CityRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
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
            'name' => 'required|min:2|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome da cidade é obrigatório!',
            'name.min'      => 'O nome da cidade deve ser maior ou igual a 2 caracteres!',
            'name.string'   => 'O nome da cidade deve ser do tipo string!'
        ];
    }
}
