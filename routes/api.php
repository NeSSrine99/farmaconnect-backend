<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::middleware('clerk.auth')->group(function () {
    Route::get('/test-user', function (Request $request) {
        return response()->json([
            'ok' => true,
            'user' => $request->auth_user,
        ]);
    });


    Route::get('/user', [UserController::class, 'index']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
});
