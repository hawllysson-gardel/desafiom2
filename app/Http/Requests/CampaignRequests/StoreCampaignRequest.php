<?php

namespace App\Http\Requests\CampaignRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
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
            'name'        => 'required|unique:campaigns|min:2|string',
            'description' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'O nome da campanha é obrigatório!',
            'name.unique'        => 'O nome da campanha já existe ou está inativado no banco de dados!',
            'name.min'           => 'O nome da campanha deve ser maior ou igual a 2 caracteres!',
            'name.string'        => 'O nome da campanha deve ser do tipo string!',

            'description.string' => 'A descrição da campanha deve ser do tipo string!'
        ];
    }
}
