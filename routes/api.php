<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Haircuts\HaircutController;
use App\Http\Controllers\Api\Haircuts\HaircutReservationController;
use App\Http\Controllers\Api\Home\HomeController;
use App\Http\Controllers\Api\Mail\MailController;
use App\Http\Controllers\User\UserController;
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
Route::get('/test', [HaircutController::class, 'getHaircutsWithReservationsFromUser']);
Route::prefix('auth')->group( function () {

    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/change-password', [AuthController::class, 'resetPassword']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('/resend-confirmation-email', [AuthController::class, 'confirmEmail']);
});
Route::get('/random-shampoos', [HomeController::class, 'randomShampoos']);


Route::get('/verify-email/{id}/{hash}', [MailController::class, 'verifyEmail'])->name('verification.verify');

Route::get('/unavailable-hours/{haircutService}', [HaircutReservationController::class, 'getHaircutReservationTimesByDate']);
Route::apiResource('haircuts/reservation', HaircutReservationController::class);
Route::apiResource('haircuts', HaircutController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/stripe/checkout', [HaircutReservationController::class, 'getCheckoutSession'])->name('stripe.session');
    Route::apiResource('users', UserController::class);
});
