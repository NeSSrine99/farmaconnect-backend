<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-db', function() {
    try {
        DB::connection()->getPdo();
        return 'DB connected!';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});


// Route::group(['middleware' => ['auth', 'role:admin']], function() {
//     Route::get('/admin/dashboard', [AdminController::class, 'index']);
// });

// Route::group(['middleware' => ['auth', 'role:pharmacien']], function() {
//     Route::get('/pharmacy/orders', [PharmacyController::class, 'orders']);
// });

