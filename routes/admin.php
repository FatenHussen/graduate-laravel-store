<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Admin\UserController;


Route::group(['middleware' => 'auth.api:admins'], function () {
    Route::get('/test', [UserController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('categories', CategoryController::class);
});

Route::apiResource('products', ProductController::class);

