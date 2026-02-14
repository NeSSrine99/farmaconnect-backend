<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\DB;

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


//test route
Route::get('/debug-db', function () {
    try {
        DB::connection()->getPdo();
        return 'DB CONNECTED ✅';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});


Route::middleware(['auth:sanctum', 'role:admin,pharmacien'])->group(function () {
    Route::post('/products', [ProductController::class, 'store']);
});
