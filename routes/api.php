<?php

use App\Http\Controllers\API\SecurityController;
use App\Http\Controllers\API\TicketApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('authenticate', [SecurityController::class, 'authenticate']);
Route::get('accounts/{id}', [SecurityController::class, 'getAccount']);
Route::post('create_account', [SecurityController::class, 'create']);
Route::delete('accounts/{id}/delete', [SecurityController::class, 'delete_account']);
Route::post('accounts/{id}/change_password', [SecurityController::class, 'changepassword']);
Route::post('accounts/{id}/update', [SecurityController::class, 'update']);
Route::get('coupons', [TicketApiController::class, 'couponLastDay']);
Route::get('coupons/day', [TicketApiController::class, 'couponDay']);
