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

// Route::get('/', function () {
//     return view('main.index');
// });

// // login
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
// Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// register

Route::get('/', function () {
    return view('auth.login');
});
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/download-tugas/{file}', [DashboardController::class, 'downloadTugas'])->name('download.tugas');
Route::get('/download-pengumpulan/{file}', [DashboardController::class, 'downloadPengumpulan'])->name('download.pengumpulan');


Route::group(['middleware' => ['auth', 'admin']], function () {
    // route kelas
    Route::resource('kelas', KelasController::class);
});

Route::group(['middleware' => ['auth', 'dosen']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // route kelas
    Route::resource('kelas', KelasController::class);
    // route tugas
    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/{id}', [TugasController::class, 'show'])->name('tugas.show');
    Route::post('/tugas', [TugasController::class, 'store'])->name('tugas.store');
    Route::post('/tugas/update/{id}', [TugasController::class, 'update'])->name('tugas.update');
    Route::post('/tugas/penilaian/{id}', [TugasController::class, 'penilaian']);
});

// Route::group(['middleware' => ['auth', 'dosen']], function () {
//     // dashboard

// });



// dashboard

//rute tugas by id_kelas
Route::get('/dashboard/{id_kelas}', [DashboardController::class, 'detailKelas'])->name('dashboard.tugas');

//rute joinkelas
Route::post('/joinkelas', [DashboardController::class, 'joinKelas'])->name('dashboard.joinKelas');