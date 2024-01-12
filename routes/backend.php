<?php

use App\Http\Controllers\Web\Auth\PasswordUpdateConreoller;
use App\Http\Controllers\Web\Backend\CustomerController;
use App\Http\Controllers\Web\Backend\CategorieController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\RiderController;
use App\Http\Controllers\Web\Backend\SupplierController;
use App\Http\Controllers\Web\Backend\UnitSettingController;
use App\Http\Controllers\Web\Backend\UserController;
use App\Http\Controllers\Web\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'App\Http\Controllers\Web\Backend',
        'prefix' => 'admin',
        'as' => 'admin.',
        // 'middleware' => ['auth','roles:admin,staff']
    ],
    function () {


        Route::resource('categories',CategorieController::class);
        Route::get('categories/delete/{category}',[CategorieController::class,'delete'])->name('categories.delete');


        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('customers',CustomerController::class);
        Route::get('customers/delete/{customer}',[CustomerController::class,'delete'])->name('customers.delete');

        Route::resource('riders',RiderController::class);
        Route::get('riders/delete/{rider}',[RiderController::class,'delete'])->name('riders.delete');

        Route::resource('suppliers',SupplierController::class);
        Route::get('suppliers/delete/{supplier}',[SupplierController::class,'delete'])->name('suppliers.delete');

        Route::resource('units',UnitSettingController::class);
        Route::get('units/delete/{unit}',[UnitSettingController::class,'delete'])->name('units.delete');

        Route::resource('users',UserController::class);
        Route::get('users/delete/{user}',[UserController::class,'delete'])->name('users.delete');

        Route::get('profile',[ProfileController::class,'show'])->name('profile');
        Route::get('profile-edit',[ProfileController::class,'edit'])->name('profile.edit');
        Route::put('profile-edit',[ProfileController::class,'update'])->name('profile.update');
        Route::put('update-password',[PasswordUpdateConreoller::class,'update'])->name('password.update');

    }
)

    ?>