<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengumpulanController;
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
Route::get('/illegal', function () {
    return view('error.forbidden');
})->name('illegal');
Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/download-tugas/{file}', [DashboardController::class, 'downloadTugas'])->name('download.tugas');
Route::get('/download-pengumpulan/{file}', [DashboardController::class, 'downloadPengumpulan'])->name('download.pengumpulan');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // route kelas
    Route::resource('kelas', KelasController::class);
    // route tugas
    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/{id}', [TugasController::class, 'show'])->name('tugas.show');

    // Admin
    // Route::group(['middleware' => ['admin']], function () {
    //     // route kelas
    //     Route::resource('kelas', KelasController::class);
    // });
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/{id}', [AuthController::class, 'userUpdate'])->name('profile.update');

    // Dosen
    Route::group(['middleware' => ['dosen']], function () {

        Route::post(
            '/tugas',
            [TugasController::class, 'store']
        )->name('tugas.store');
        Route::post('/tugas/update/{id}', [TugasController::class, 'update'])->name('tugas.update');
        Route::post('/tugas/penilaian/{id}', [TugasController::class, 'penilaian']);
        Route::delete('/kelas/delete/{id}', [KelasController::class, 'delete'])->name('kelas.delete');

        Route::get('/tugas/delete/{id}', [TugasController::class, 'destroy'])->name('tugas.destroy');
    });

    // Mahasiswa
    Route::group(['middleware' => ['mahasiswa']], function () {
        Route::post('/pengumpulan/{id}', [PengumpulanController::class, 'store'])->name('pengumpulan.store');
        Route::get('/pengumpulan/{id}', [PengumpulanController::class, 'destroy'])->name('pengumpulan.destroy');
        Route::post(
            '/joinkelas',
            [KelasController::class, 'joinkelas']
        )->name('joinkelas.store');
        Route::get('/kelas-keluar/{id}', [KelasController::class, 'keluar'])->name('kelas.keluar');
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::post('/user-create', [AuthController::class, 'store'])->name('user.create');
        Route::get('/user-delete/{id}', [AuthController::class, 'destroy'])->name('user.delete');
    });
});












// dashboard

// //rute tugas by id_kelas
// Route::get('/dashboard/{id_kelas}', [DashboardController::class, 'detailKelas'])->name('dashboard.tugas');

// //rute joinkelas
// Route::post('/joinkelas', [DashboardController::class, 'joinKelas'])->name('dashboard.joinKelas');