<?php

namespace App\Http\Requests\ProductRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name'        => 'nullable|min:2|string',
            'description' => 'nullable|string',
            'price'       => ['nullable', 'regex:/^\d+(\.\d{1,2})?$/']
        ];
    }

    public function messages()
    {
        return [
            'name.min'           => 'O nome do produto deve ser maior ou igual a 2 caracteres!',
            'name.string'        => 'O nome do produto deve ser do tipo string!',

            'description.string' => 'A descrição do produto deve ser do tipo string!',

            'price.regex'        => 'O preço do produto deve seguir o padrão 99.99!'
        ];
    }
}