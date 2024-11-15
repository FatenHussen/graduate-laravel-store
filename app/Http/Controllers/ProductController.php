<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\FilterProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends BaseCRUDController
{
    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
        $this->createRequest = StoreProductRequest::class;
        $this->updateRequest = UpdateProductRequest::class;
        $this->filterRequest = FilterProductRequest::class; // Optional filter request for products
    }
}
