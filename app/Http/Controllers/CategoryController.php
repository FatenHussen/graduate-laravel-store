<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\CategoryFilterRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends BaseIndexController
{
    public function __construct(CategoryService $categoryService)
    {
        $this->service = $categoryService;
        $this->createRequest = StoreCategoryRequest::class;
        $this->updateRequest = UpdateCategoryRequest::class;
        $this->filterRequest = CategoryFilterRequest::class; // Optional filter request for categories
    }
}
