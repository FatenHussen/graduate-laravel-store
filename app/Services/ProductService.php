<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Storage;

class ProductService extends BaseService
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    /**
     * Filter products based on specified criteria.
     *
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function filterProducts(array $filters = [])
    {
        $query = $this->model::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['description'])) {
            $query->where('description', 'like', '%' . $filters['description'] . '%');
        }

        if (!empty($filters['company'])) {
            $query->where('company', 'like', '%' . $filters['company'] . '%');
        }

        if (!empty($filters['expiration_date'])) {
            $query->where('expiration_date', '=', $filters['expiration_date']);
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        }

        if (!empty($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }

        if (!empty($filters['stock_min'])) {
            $query->where('stock', '>=', $filters['stock_min']);
        }

        if (!empty($filters['stock_max'])) {
            $query->where('stock', '<=', $filters['stock_max']);
        }

        if (!empty($filters['ingredients'])) {
            $query->where('ingredients', 'like', '%' . $filters['ingredients'] . '%');
        }

        return $query->get();
    }

    /**
     * Upload product images and return their paths.
     *
     * @param array $images
     * @return array
     */
    protected function uploadImages(array $images)
    {
        $imagePaths = [];

        foreach ($images as $image) {
            // Store each image in the 'public/products' directory
            $path = $image->store('public/products');
            $imagePaths[] = Storage::url($path); // Convert to URL-friendly path
        }

        return $imagePaths;
    }

    /**
     * Create a product with images.
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function create(array $data)
    {
        if (isset($data['images']) && is_array($data['images'])) {
            $data['images'] = $this->uploadImages($data['images']);
        }

        return parent::create($data);
    }

    /**
     * Update a product with new images if provided.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Product
     */
    public function update($id, array $data)
    {
        if (isset($data['images']) && is_array($data['images'])) {
            $data['images'] = $this->uploadImages($data['images']);
        }

        return parent::update($id, $data);
    }
    public function addProductToCart($userId, $productId, $quantity)
    {
        // Find or create a cart for the user
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Check if the product already exists in the cart and update/create the CartItem
        $cartItem = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $productId],
            ['quantity' => \DB::raw("quantity + $quantity")]
        );

        return $cartItem;
    }
}
