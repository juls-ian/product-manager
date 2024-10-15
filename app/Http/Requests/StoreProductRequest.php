<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [      // validation rule of products
            // column    //requirements
            'name' => ['required', 'string', 'min:5'],
            'brand' => ['required', 'string', 'min:5'],
            'category_id' => ['required', 'exists:categories,id'], //id exist in categories table
            'price' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'desc' => ['required', 'string']
        ];
    }

    public function attributes()
    {
        return  [
            'category_id' => 'category'
        ];
    }

    // convert $ to cent | $1 = 100
    public function prepareForValidation()
    {
        $this->merge([
            'price' => $this->price * 100
        ]);
    }
}
