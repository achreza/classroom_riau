<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TugasController;
use Illuminate\Routing\RouteGroup;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.login');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
    // logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    // route kelas
    Route::resource('kelas', KelasController::class);
});

Route::group(['middleware' => ['auth', 'dosen']], function () {
    // route kelas
    Route::resource('kelas', KelasController::class);
    // route tugas
    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/{id}', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/tugas', [TugasController::class, 'store'])->name('tugas.store');
});

Route::group(['middleware' => ['auth', 'dosen']], function () {
   // dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});



// register
