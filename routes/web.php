<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardSaranController;
use App\Http\Controllers\DashboardCancelController;
use App\Http\Controllers\DashboardOnholdController;
use App\Http\Controllers\DashboardPengurusController;
//Tampilan Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post');
Route::get('registration', [LoginController::class, 'registration'])->name('register');
Route::post('post-registration', [LoginController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [LoginController::class, 'dashboard']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


// ========================================= Halaman Dashboard ========================================= //
//Login Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return to_route('dashboard.index');
    });
    Route::name('dashboard.')->group(function () {
        Route::group(['controller' => DashboardController::class], function () {
            Route::get('/dashboard', 'index')->name('index');
            Route::post('/dashboard-rekap/filter', [DashboardController::class, 'filter'])->name('dashboard-rekap.filter');
        });
        //Pengurus
        Route::middleware(['auth', 'user-access:admin'])->group(function () {
            Route::resource('/kelola-pengurus', AdminController::class);
            Route::resource('/biodata-pengurus', DashboardPengurusController::class);
        });
        //Onhold
        Route::resource('/onhold', DashboardOnholdController::class);
        //Cancel
        Route::resource('/cancel', DashboardCancelController::class);
        //Alasan
        Route::resource('/saran', DashboardSaranController::class);
        Route::get('/onhold/generate/{resi}', [DashboardOnholdController::class, 'generateQrCode'])->name('qrcode.generate');
    });
});
