<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CityController;
use App\Http\Controllers\User\ProfileController;

Route::group(["middleware" => ['setLocale']], function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/send_otp', [AuthController::class, 'send_otp']);
    Route::post('/verify_otp', [AuthController::class, 'verify_otp']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/send_password', [AuthController::class, 'send_password']);
    Route::post('/verify_password', [AuthController::class, 'verify_password']);

    Route::middleware(['auth.api:users'])->group(function () {
            Route::get('/delete_account', [ProfileController::class, 'delete_account']);
            Route::get('/logout', [AuthController::class, 'logout']);
        Route::prefix('/profile')->group(function () {
            Route::get('/', [ProfileController::class, 'get_profile']);
            Route::post('/update', [ProfileController::class, 'update_profile']);
            Route::post('/update_password', [ProfileController::class, 'update_password']);
        });
        Route::middleware(['auth:sanctum', 'abilities:reset-password'])->group(function () {
            Route::post('/reset_password', [AuthController::class, 'reset_password']);
        });

    });
    Route::prefix('/cities')->group(function () {
        Route::get('/', [CityController::class, 'all_cities']);
    });

});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('products', ProductController::class);
    // Route::post('/cart/add', [CartController::class, 'store']);


    // Route::get('products', [ProductController::class, 'index']);  // View and filter products
    // Route::get('products/{id}', [ProductController::class, 'show']); // View single product
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);           // Add to cart
    Route::put('/cart/update', [CartController::class, 'update']);        // Update item quantity
    Route::delete('/cart/remove', [CartController::class, 'destroy']);    // Remove from cart
    Route::get('/cart', [CartController::class, 'index']);                // View cart
});
// Route::apiResource('products', ProductController::class);

// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::get('products', [CategoryController::class, 'index']);  // View and filter products
//     Route::get('products/{id}', [CategoryController::class, 'show']); // View single product
// });