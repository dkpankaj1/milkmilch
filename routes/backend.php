<?php
use App\Http\Controllers\Web\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'App\Http\Controllers\Web\Backend',
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth']
    ],
    function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    }
)

    ?>