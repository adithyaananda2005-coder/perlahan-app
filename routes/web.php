<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Masyarakat\ProfilController;

Route::view('/', 'welcome')->name('home');

// Registrasi masyarakat
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

// Logout pengguna yang sudah login
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Dashboard umum pengguna yang sudah login
Route::get('/dashboard', function () {
    return match (Auth::user()->role) {
        'admin' => redirect('/admin'),
        'petugas_lapangan' => redirect('/petugas'),
        default => redirect('/masyarakat'),
    };
})->middleware('auth')->name('dashboard');

// Halaman masyarakat
Route::view('/masyarakat', 'masyarakat.index')
    ->middleware(['auth', 'role:masyarakat'])
    ->name('masyarakat.index');

// Halaman admin dan petugas akan dibuat pada langkah berikutnya

// Dashboard admin
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.index');

// Dashboard petugas lapangan
Route::get('/petugas', [PetugasController::class, 'index'])
    ->middleware(['auth', 'role:petugas_lapangan'])
    ->name('petugas.index');

Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('/masyarakat/lahan', [LahanController::class, 'index'])
        ->name('masyarakat.lahan.index');

    Route::get('/masyarakat/lahan/{id}', [LahanController::class, 'show'])
        ->whereNumber('id')
        ->name('masyarakat.lahan.show');
});

Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('/masyarakat/pengajuan', [PengajuanController::class, 'index'])
        ->name('masyarakat.pengajuan.index');

    Route::get('/masyarakat/pengajuan/buat', [PengajuanController::class, 'create'])
        ->name('masyarakat.pengajuan.create');

    Route::post('/masyarakat/pengajuan', [PengajuanController::class, 'store'])
        ->name('masyarakat.pengajuan.store');
});

Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('/masyarakat/profil', [ProfilController::class, 'show'])
        ->name('masyarakat.profil.show');

    Route::put('/masyarakat/profil', [ProfilController::class, 'update'])
        ->name('masyarakat.profil.update');
});