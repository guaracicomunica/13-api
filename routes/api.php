<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use \App\Http\Controllers\API\UserController;
use \App\Http\Controllers\API\CvliController;
use \App\Http\Controllers\API\TypeCvliController;
use \App\Http\Controllers\API\RoleController;
use \App\Http\Controllers\API\DenunciationController;
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
    Route::get('unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');
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
    'prefix' => 'cvlis'
], function ($router) {
    Route::get('types', [TypeCvliController::class, 'index']);
    Route::post('types', [TypeCvliController::class, 'store']);
    Route::get('', [CvliController::class, 'index']);
    Route::get('{id}', [CvliController::class, 'show']);
    Route::post('', [CvliController::class, 'store']);
});

Route::group([
    'prefix' => 'roles'
], function ($router) {
    Route::get('', [RoleController::class, 'index']);
});

Route::group([
    'prefix' => 'denunciations'
], function ($router) {
    Route::get('', [DenunciationController::class, 'index']);
    Route::get('{id}', [DenunciationController::class, 'show']);
    Route::post('', [DenunciationController::class, 'store']);
});
