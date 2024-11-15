<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService extends BaseService
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new category with images.
     */
    public function create(array $data)
    {
        // Handle image upload if images are provided
        if (isset($data['images']) && is_array($data['images'])) {
            $data['images'] = $this->uploadImages($data['images']);
        }

        return parent::create($data);
    }

    /**
     * Update an existing category with new images.
     */
    public function update($id, array $data)
    {
        // Handle image upload if images are provided
        if (isset($data['images']) && is_array($data['images'])) {
            $data['images'] = $this->uploadImages($data['images']);
        }

        return parent::update($id, $data);
    }

    /**
     * Upload multiple images and store their paths.
     */
    protected function uploadImages(array $images)
    {
        $imagePaths = [];

        foreach ($images as $image) {
            // Store each image in 'public/categories' directory
            $path = $image->store('public/categories');
            // Convert the path to a URL-friendly format
            $imagePaths[] = Storage::url($path);
        }

        return $imagePaths;
    }

    /**
     * Retrieve all categories with fully qualified image URLs.
     */
    public function getAllWithImages(array $filters = [])
    {
        $query = Category::query();

        // Apply name filter if provided
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        // You can add additional filters here as needed, for example:
        if (!empty($filters['description'])) {
            $query->where('description', 'like', '%' . $filters['description'] . '%');
        }

        return $query->get()->map(function ($category) {
            // Convert image paths to fully qualified URLs
            $category->images = array_map(function ($image) {
                return url($image);
            }, $category->images ?? []);

            return $category;
        });
    }

    public function getOneWithImages($id)
    {
        $category = Category::findOrFail($id);

        $category->images = array_map(function ($image) {
            return url($image);
        }, $category->images ?? []);

        return $category;
    }
}