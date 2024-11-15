<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ensure authorization here if needed
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id', // Must reference a valid product
            'quantity' => 'required|integer|min:1',        // Minimum quantity is 1
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Product ID is required.',
            'product_id.exists' => 'The selected product does not exist.',
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be a whole number.',
            'quantity.min' => 'Quantity must be at least 1.',
        ];
    }
}
