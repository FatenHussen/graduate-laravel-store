<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreCategoryRequest extends BaseRequest
{
    public function rules(): array 
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
            'images' => 'nullable|array|max:10', // Accept an array of images, up to 10
            'images.*' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048', // Each file should be an image
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The category name is required.',
            'name.string' => 'The category name must be a string.',
            'name.max' => 'The category name may not be greater than 255 characters.',
            'name.unique' => 'A category with this name already exists.',
            
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            
            'images.array' => 'The images field must be an array.',
            'images.max' => 'You can upload a maximum of 10 images.',
            
            'images.*.file' => 'Each image must be a valid file.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif.',
            'images.*.max' => 'Each image may not be greater than 2048 KB.',
        ];
    }
}
