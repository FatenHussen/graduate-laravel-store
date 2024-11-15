<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to filter products
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'company' => 'nullable|string|max:255',
            'expiration_date' => 'nullable|date',
            'category_id' => 'nullable|exists:categories,id',
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|min:0',
            'stock_min' => 'nullable|integer|min:0',
            'stock_max' => 'nullable|integer|min:0',
            'ingredients' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Name filter must be a string.',
            'description.string' => 'Description filter must be a string.',
            'company.string' => 'Company filter must be a string.',
            'expiration_date.date' => 'Expiration date filter must be a valid date.',
            'category_id.exists' => 'The selected category does not exist.',
            'price_min.numeric' => 'Minimum price must be a number.',
            'price_max.numeric' => 'Maximum price must be a number.',
            'stock_min.integer' => 'Minimum stock quantity must be an integer.',
            'stock_max.integer' => 'Maximum stock quantity must be an integer.',
            'ingredients.string' => 'Ingredients filter must be a string.',
        ];
    }
}
