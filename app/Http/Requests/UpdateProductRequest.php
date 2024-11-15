<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        // Only allow admin to update a product
        return auth()->user()->is_admin;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'company' => 'sometimes|required|string|max:255',
            'expiration_date' => 'nullable|date|after:today',
            'category_id' => 'sometimes|required|exists:categories,id',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required when updating.',
            'company.required' => 'Company name is required when updating.',
            'expiration_date.date' => 'Expiration date must be a valid date.',
            'expiration_date.after' => 'Expiration date must be in the future.',
            'category_id.required' => 'Category is required when updating.',
            'category_id.exists' => 'The selected category does not exist.',
            'price.required' => 'Price is required when updating.',
            'price.numeric' => 'Price must be a number.',
            'stock.required' => 'Stock quantity is required when updating.',
            'stock.integer' => 'Stock quantity must be an integer.',
            'images.array' => 'Images must be an array.',
            'images.*.image' => 'Each image must be a valid image file.',
            'images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif.',
            'ingredients.string' => 'Ingredients must be a string.',
        ];
    }
}
