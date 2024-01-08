<?php
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'App\Http\Controllers\Web\Backend',
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth']
    ],
    function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('profile',[ProfileController::class,'show'])->name('profile');
        Route::get('profile-edit',[ProfileController::class,'edit'])->name('profile.edit');
        Route::put('profile-edit',[ProfileController::class,'update'])->name('profile.update');

    }
)

    ?>