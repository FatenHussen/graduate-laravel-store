<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartService extends BaseService
{
    public function __construct(Cart $cart)
    {
        parent::__construct($cart);
    }

    /**
     * Add or update a product in the cart.
     *
     * @param int $userId
     * @param int $productId
     * @param int $quantity
     * @return CartItem
     */
    public function addProductToCart($userId, $productId, $quantity)
    {
        \Log::info('Adding product to cart', ['user_id' => $userId]);

        // Ensure the cart is created with the correct user ID
        $cart = Cart::firstOrCreate(
            ['user_id' => $userId],
            ['user_id' => $userId]
        );

        \Log::info('Cart created or retrieved', ['cart_id' => $cart->id, 'cart_user_id' => $cart->user_id]);

        // Add or update the cart item
        $cartItem = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $productId],
            ['quantity' => \DB::raw("quantity + $quantity")] // Increment quantity if item already exists
        );

        return $cartItem;
    }
    

    /**
     * Update quantity of a product in the cart.
     *
     * @param int $userId
     * @param int $productId
     * @param int $quantity
     * @return CartItem
     */
    public function updateCartItem($userId, $productId, $quantity)
    {
        $cart = Cart::where('user_id', $userId)->firstOrFail();

        $cartItem = $cart->cartItems()->where('product_id', $productId)->firstOrFail();
        $cartItem->update(['quantity' => $quantity]);

        return $cartItem;
    }

    /**
     * Remove a product from the cart.
     *
     * @param int $userId
     * @param int $productId
     * @return void
     */
    public function removeProductFromCart($userId, $productId)
    {
        $cart = Cart::where('user_id', $userId)->firstOrFail();
        $cart->cartItems()->where('product_id', $productId)->delete();
    }

    /**
     * View cart contents.
     *
     * @param int $userId
     * @return array
     */
    public function viewCart($userId)
    {
        $cart = Cart::with('cartItems.product')->where('user_id', $userId)->first();

        if (!$cart) {
            return ['cartItems' => [], 'total' => 0];
        }

        // Calculate the total price of items in the cart
        $total = $cart->cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });

        return [
            'cartItems' => $cart->cartItems,
            'total' => $total
        ];
    }
}
