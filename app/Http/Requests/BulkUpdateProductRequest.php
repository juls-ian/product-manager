<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkUpdateProductRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id'], //id exist in categories table
            'product_ids' => ['required', 'array']
        ];
    }

    public function attributes()
    {
        return  [
            'category_id' => 'category'
        ];
    }
}