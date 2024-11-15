<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveFromCartRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ensure authorization here if needed
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id', // Must reference a valid product
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Product ID is required.',
            'product_id.exists' => 'The selected product does not exist.',
        ];
    }
}
