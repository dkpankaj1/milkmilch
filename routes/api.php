<?php

use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\CustomerRegisterController;
use App\Http\Controllers\Api\Auth\NewPasswordController;
use App\Http\Controllers\Api\Auth\PasswordResetOtpController;
use App\Http\Controllers\Api\Auth\PasswordUpdateController;
use App\Http\Controllers\Api\Backend\RiderController;
use App\Http\Controllers\Api\Backend\SellController;
use App\Http\Controllers\Api\Backend\SupplierController;
use App\Http\Controllers\Api\Backend\UserController;
use App\Http\Controllers\Api\Profile\ProfileController;
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

Route::post('register', [CustomerRegisterController::class, "store"]);

Route::post('login', [AuthenticatedSessionController::class, "store"]);
Route::post('forgot-password', [PasswordResetOtpController::class, "store"]);
Route::put('reset-password', [NewPasswordController::class, 'store']);


Route::group(['middleware' => ['auth:sanctum','api_roles:customer,rider,supplier,admin']], function () {

    // sell api::begin
    Route::get('customers',[SellController::class,'getCustomer']);
    Route::get('search-stock',[SellController::class,'searchStock']);
    Route::get('get-stock',[SellController::class,'getStock']);
    Route::apiResource('sells',SellController::class);
    // sell api::end


    Route::apiResource('riders',RiderController::class);
    Route::apiResource('suppliers',SupplierController::class);
    Route::apiResource('users', UserController::class);

    Route::get('profile',[ProfileController::class,'show']);
    Route::put('profile-update',[ProfileController::class,'update']);
    Route::put('update-password',[PasswordUpdateController::class,'update']);
    Route::post("logout", [AuthenticatedSessionController::class, "destroy"]);
});
