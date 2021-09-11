<?php

namespace App\Http\Requests\CityRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
            'name'          => 'required|min:2|string',
            'city_group_id' => 'nullable|numeric|digits_between:1,20'
        ];
    }

    public function messages()
    {
        return [
            'name.required'                => 'O nome da cidade é obrigatório!',
            'name.min'                     => 'O nome da cidade deve ser maior ou igual a 2 caracteres!',
            'name.string'                  => 'O nome da cidade deve ser do tipo string!',

            'city_group_id.numeric'        => 'O ID do grupo de cidades deve ser do tipo inteiro!',
            'city_group_id.digits_between' => 'O ID do grupo de cidades deve ter no máximo 20 digitos!'
        ];
    }
}
