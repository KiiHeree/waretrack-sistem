<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DeliveryOrderController;
use App\Http\Controllers\Api\DriverController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);


    Route::get('get-driver/{id}',[DriverController::class, 'get_driver']);
    Route::get('get-order-by-driver/{id}',[DeliveryOrderController::class, 'get_order_by_driver']);
    Route::post('update-status-order/{id}',[DeliveryOrderController::class, 'updateStatusOrder']);
    Route::get('get-order-delivered-by-driver/{id}',[DeliveryOrderController::class, 'getOrderDelivered']);
});
