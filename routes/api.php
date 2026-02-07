<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Public routes (NO AUTH)
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/products/related/{id}', [ProductController::class, 'related']);

/*
|--------------------------------------------------------------------------
| Protected routes (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware('clerk.auth')->group(function () {

    Route::get('/test-user', function (Request $request) {
        return response()->json([
            'ok' => true,
            'user' => $request->auth_user,
        ]);
    });

    Route::get('/user', [UserController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
});
