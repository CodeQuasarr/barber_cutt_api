<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\Shoppings\HaircutServiceController;
use App\Http\Controllers\Api\Shoppings\ProductController;
use App\Http\Controllers\Api\Users\UserController;
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
Route::apiResource('products', ProductController::class);
Route::apiResource('haircut-lists', HaircutServiceController::class);
Route::get('countries', [CountryController::class, 'getCountry']);
Route::prefix('auth')->group( function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::ApiResource('users', UserController::class);
});
