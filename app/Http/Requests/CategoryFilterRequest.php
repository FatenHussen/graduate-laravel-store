<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFilterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users to filter categories
    }

    public function rules()
    {
        return [
            'name' => 'string|nullable', // Filter by name
            'created_at' => 'date|nullable', // Filter by creation date
            // Add more filter fields as needed
            'description' => 'string|nullable',
        
        ];
    }
}
