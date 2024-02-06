<?php

use App\Http\Controllers\AbsensimasterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KuliahController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulmasterController;
use App\Http\Controllers\ModulmasterController;
use App\Http\Controllers\PertemuanmasterController;
use App\Http\Controllers\KeaktifanmasterController;
use App\Http\Controllers\KuismasterController;
use App\Http\Controllers\TugasmasterController;
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
    Route::post('kuliah/{id}/updateProfile', [KuliahController::class, 'updateProfile']);

    // Mata Kuliah
    Route::get('matkul', [KuliahController::class, 'matkul']);
    Route::get('matkul/{id}/pertemuan', [KuliahController::class, 'pertemuan']);
    Route::get('matkul/{matkul_id}/pertemuan/{id}/detail', [KuliahController::class, 'detail']);
    Route::get('modul', [KuliahController::class, 'modul']);
    Route::get('penilaian', [KuliahController::class, 'penilaian']);
    Route::get('rekap', [KuliahController::class, 'rekap']);
    Route::get('kontak', [KuliahController::class, 'kontak']);
    Route::get('jadwal', [KuliahController::class, 'jadwal']);

    // Keaktifan
    Route::get('keaktifan', [KuliahController::class, 'keaktifan']);
    Route::get('keaktifan/{id}/edit', [KuliahController::class, 'editkeaktifan']);
    Route::post('keaktifan/{id}/update', [KuliahController::class, 'updatekeaktifan']);

    // Kuis
    Route::get('kuis', [KuliahController::class, 'kuis']);
    Route::get('kuis/{id}/edit', [KuliahController::class, 'editkuis']);
    Route::post('kuis/{id}/update', [KuliahController::class, 'updatekuis']);

    // Tugas
    Route::get('tugas', [KuliahController::class, 'tugas']);
    Route::get('tugas/{id}/edit', [KuliahController::class, 'edittugas']);
    Route::post('tugas/{id}/update', [KuliahController::class, 'updatetugas']);

    // Absensi
    Route::get('absensi', [KuliahController::class, 'absensi']);
    Route::get('absensi/{id}/kamera', [KuliahController::class, 'kamera']);
    Route::post('absensi/store', [KuliahController::class, 'store']);
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

    // Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
    Route::post('/mahasiswa/edit', [MahasiswaController::class, 'edit']);
    Route::post('/mahasiswa/{id}/update', [MahasiswaController::class, 'update']);
    Route::post('/mahasiswa/{id}/delete', [MahasiswaController::class, 'delete']);

    // Matkul
    Route::get('/matkulmaster', [MatkulmasterController::class, 'index']);
    Route::post('/matkulmaster/store', [MatkulmasterController::class, 'store']);
    Route::post('/matkulmaster/edit', [MatkulmasterController::class, 'edit']);
    Route::post('/matkulmaster/{id}/update', [MatkulmasterController::class, 'update']);
    Route::post('/matkulmaster/{id}/delete', [MatkulmasterController::class, 'delete']);

    // Pertemuan
    Route::get('/pertemuanmaster', [PertemuanmasterController::class, 'index']);
    Route::post('/pertemuanmaster/store', [PertemuanmasterController::class, 'store']);
    Route::post('/pertemuanmaster/edit', [PertemuanmasterController::class, 'edit']);
    Route::post('/pertemuanmaster/{id}/update', [PertemuanmasterController::class, 'update']);
    Route::post('/pertemuanmaster/{id}/delete', [PertemuanmasterController::class, 'delete']);

    // Modul
    Route::get('/modulmaster', [ModulmasterController::class, 'index']);
    Route::post('/modulmaster/store', [ModulmasterController::class, 'store']);
    Route::post('/modulmaster/edit', [ModulmasterController::class, 'edit']);
    Route::post('/modulmaster/{id}/update', [ModulmasterController::class, 'update']);
    Route::post('/modulmaster/{id}/delete', [ModulmasterController::class, 'delete']);

    // Keaktifan
    Route::get('/keaktifanmaster', [KeaktifanmasterController::class, 'index']);
    Route::post('/keaktifanmaster/store', [KeaktifanmasterController::class, 'store']);
    Route::post('/keaktifanmaster/edit', [KeaktifanmasterController::class, 'edit']);
    Route::post('/keaktifanmaster/{id}/update', [KeaktifanmasterController::class, 'update']);
    Route::post('/keaktifanmaster/{id}/delete', [KeaktifanmasterController::class, 'delete']);

    // Kuis
    Route::get('/kuismaster', [KuismasterController::class, 'index']);
    Route::post('/kuismaster/store', [KuismasterController::class, 'store']);
    Route::post('/kuismaster/edit', [KuismasterController::class, 'edit']);
    Route::post('/kuismaster/{id}/update', [KuismasterController::class, 'update']);
    Route::post('/kuismaster/{id}/delete', [KuismasterController::class, 'delete']);

    // Tugas
    Route::get('/tugasmaster', [TugasmasterController::class, 'index']);
    Route::post('/tugasmaster/store', [TugasmasterController::class, 'store']);
    Route::post('/tugasmaster/edit', [TugasmasterController::class, 'edit']);
    Route::post('/tugasmaster/{id}/update', [TugasmasterController::class, 'update']);
    Route::post('/tugasmaster/{id}/delete', [TugasmasterController::class, 'delete']);

    // Absensi
    Route::get('/absensimaster', [AbsensimasterController::class, 'index']);
    Route::post('/absensimaster/store', [AbsensimasterController::class, 'store']);
    Route::post('/absensimaster/edit', [AbsensimasterController::class, 'edit']);
    Route::post('/absensimaster/{id}/update', [AbsensimasterController::class, 'update']);
    Route::post('/absensimaster/{id}/delete', [AbsensimasterController::class, 'delete']);

    // Rekap
    Route::get('rekapmaster', [KuliahController::class, 'rekapmaster']);
    Route::get('cetakrekap', [KuliahController::class, 'cetakrekap']);
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
