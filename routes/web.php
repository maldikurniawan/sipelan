<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KuliahController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
});

Route::middleware(['guest:admin'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('home', [HomeController::class, 'index']);

    // Edit Profile
    Route::get('editProfile', [KuliahController::class, 'editProfile']);
    Route::post('/kuliah/{id}/updateProfile', [KuliahController::class, 'updateProfile']);

    // Mata Kuliah
    Route::get('matkul', [KuliahController::class, 'matkul']);
    Route::get('/matkul/{id}/pertemuan', [KuliahController::class, 'pertemuan']);
    Route::get('/pertemuan/{id}/detail', [KuliahController::class, 'detail']);
    Route::get('modul', [KuliahController::class, 'modul']);
    Route::get('penilaian', [KuliahController::class, 'penilaian']);
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('proseslogout', [AuthController::class, 'proseslogout']);
    Route::get('/panel/homeadmin', [HomeController::class, 'homeadmin']);

    // Dosen
    Route::get('/dosen', [DosenController::class, 'index']);
    Route::post('/dosen/store', [DosenController::class, 'store']);
    Route::post('/dosen/edit', [DosenController::class, 'edit']);
    Route::post('/dosen/{id}/update', [DosenController::class, 'update']);
    Route::post('/dosen/{id}/delete', [DosenController::class, 'delete']);
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
