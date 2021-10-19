<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use \App\Http\Controllers\API\UserController;
use \App\Http\Controllers\API\CategoryController;
use \App\Http\Controllers\API\RoleController;
use \App\Http\Controllers\API\ProductController;
use \App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CartProductController;
use \App\Http\Controllers\API\SizeController;
use \App\Http\Controllers\API\NewsletterController;
use \App\Http\Controllers\API\MaterialController;
use \App\Http\Controllers\API\ColorController;
use App\Http\Controllers\API\ProductTypeController;

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

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('user', [AuthController::class, 'user']);
});

Route::group([
    'prefix' => 'users'
], function ($router) {
    Route::get('', [UserController::class, 'index']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});

Route::group([
    'prefix' => 'categories'
], function ($router) {
    Route::get('', [CategoryController::class, 'index']);
});

Route::group([
    'prefix' => 'roles'
], function ($router) {
    Route::get('', [RoleController::class, 'index']);
});

Route::group([
    'prefix' => 'products'
], function($router) {
    Route::post('', [ProductController::class, 'store']);
    Route::get('', [ProductController::class, 'index']);
    Route::get('trend', [ProductController::class, 'trend']);
    Route::get('latest', [ProductController::class, 'latest']);
    Route::get('lowestprice', [ProductController::class, 'lowestprice']);
    Route::get('highestprice', [ProductController::class, 'highestprice']);
    Route::get('{id}', [ProductController::class, 'show']);
});

Route::group([
    'prefix' => 'newsletter'
], function($router) {
    Route::post('subscribe', [NewsletterController::class, 'store']);
    Route::post('promo/send', [NewsletterController::class, 'sendPromo']);
});


Route::group([
    'prefix' => 'brands'
], function($router) {
    Route::get('', [BrandController::class, 'index']);
});

Route::group([
    'prefix' => 'sizes'
], function($router) {
    Route::get('', [SizeController::class, 'index']);
});

Route::group([
    'prefix' => 'materials'
], function($router) {
    Route::get('', [MaterialController::class, 'index']);
});

Route::group([
    'prefix' => 'colors'
], function($router) {
    Route::get('', [ColorController::class, 'index']);
});

Route::group([
    'prefix' => 'product-types'
], function($router) {
    Route::get('', [ProductTypeController::class, 'index']);
});

Route::group([
    'prefix' => 'carts'
], function($router) {
    Route::get('{id}', [CartProductController::class, 'listProductsByCart']);
    Route::post('', [CartController::class, 'store']);
    Route::get('lastcart/{id}', [CartController::class, 'lastcart']);
    Route::get('productsinfo/{id}', [CartProductController::class, 'listProductInformationByCart']);
    Route::put('product/{id}', [CartProductController::class, 'updateProductQuantity']);
    Route::delete('product/{id}', [CartProductController::class, 'deleteProductInCart']);
});
