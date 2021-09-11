<?php

namespace App\Http\Requests\CityGroupRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityGroupRequest extends FormRequest
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
            'name'        => 'nullable|unique:city_groups|min:2|string',
            'description' => 'nullable|string',
            'campaign_id' => 'nullable|numeric|digits_between:1,20'
        ];
    }

    public function messages()
    {
        return [
            'name.unique'                => 'O nome do grupo de cidades já existe ou está inativado no banco de dados!',
            'name.min'                   => 'O nome do grupo de cidades deve ser maior ou igual a 2 caracteres!',
            'name.string'                => 'O nome do grupo de cidades deve ser do tipo string!',

            'description.string'         => 'A descrição do grupo de cidades deve ser do tipo string!',

            'campaign_id.numeric'        => 'O ID da campanha deve ser do tipo inteiro!',
            'campaign_id.digits_between' => 'O ID da campanha deve ter no máximo 20 digitos!'
        ];
    }
}
