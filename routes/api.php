<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::resource('products', ProductController::class);

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    //category
    Route::resource('categories', CategoryController::class);
    Route::get('/categories/search/{name}', [CategoryController::class, 'search']);
    Route::get('/categories/{id}/products', [CategoryController::class, 'products']);

    //products
    Route::resource('products', ProductController::class);
    Route::get('/products/search/{name}', [ProductController::class, 'search']);
    Route::get('/products/{id}/category', [ProductController::class, 'category']);

    //user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
