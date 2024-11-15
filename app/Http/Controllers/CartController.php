<?php

namespace App\Http\Controllers;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\RemoveFromCartRequest;
use App\Http\Requests\UpdateCartItemRequest;

class CartController extends BaseCRUDController
{
    public function __construct(CartService $cartService)
    {
        $this->service = $cartService;
        $this->createRequest = AddToCartRequest::class;
        $this->updateRequest = UpdateCartItemRequest::class;
        $this->deleteRequest = RemoveFromCartRequest::class;
    }

    public function addToCart(AddToCartRequest $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 403);
        }

        $data = $request->validated();

        // Add product to the cart
        $cartItem = $this->service->addProductToCart($userId, $data['product_id'], $data['quantity']);

        return response()->json($cartItem, 200);
    }
}
