<?php

namespace App\Http\Requests\DiscountRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest
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
            'name'        => 'required|unique:discounts|min:2|string',
            'description' => 'nullable|string',
            'percentage'  => 'required|numeric|between:0,100'
        ];
    }

    public function messages()
    {
        return [
            'name.required'       => 'O nome do desconto é obrigatório!',
            'name.unique'         => 'O nome do desconto já existe ou está inativado no banco de dados!',
            'name.min'            => 'O nome do desconto deve ser maior ou igual a 2 caracteres!',
            'name.string'         => 'O nome do desconto deve ser do tipo string!',

            'description.string'  => 'A descrição do desconto deve ser do tipo string!',

            'percentage.required' => 'A porcentagem do desconto é obrigatório!',
            'percentage.numeric'  => 'A porcentagem do desconto deve ser do tipo numérico!',
            'percentage.between'  => 'A porcentagem do desconto deve ser entre 0%-100%!'
        ];
    }
}
