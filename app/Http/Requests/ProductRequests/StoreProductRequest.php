<?php

namespace App\Http\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'        => 'required|min:2|string',
            'description' => 'nullable|string',
            'price'       => ['required', 'regex:/^\d+(\.\d{1,2})?$/']
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'O nome do produto é obrigatório!',
            'name.min'           => 'O nome do produto deve ser maior ou igual a 2 caracteres!',
            'name.string'        => 'O nome do produto deve ser do tipo string!',

            'description.string' => 'A descrição do produto deve ser do tipo string!',

            'price.required'     => 'O preço do produto é obrigatório!',
            'price.regex'        => 'O preço do produto deve seguir o padrão 99.99!'
        ];
    }
}
