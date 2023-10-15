<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('login');
});

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// register
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// route kelas
Route::resource('kelas', KelasController::class);

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//rute tugas by id_kelas
Route::get('/dashboard/{id_kelas}', [DashboardController::class, 'detailKelas'])->name('dashboard.tugas');

//rute joinkelas
Route::post('/joinkelas', [DashboardController::class, 'joinKelas'])->name('dashboard.joinKelas');
