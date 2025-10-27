<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\VisiController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\{
    DashboardController,
    JenisHewanController,
    RasHewanController,
    KategoriController,
    KategoriKlinisController,
    KodeTerapiController,
    PetController,
    RoleController,
    UserController
};
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Dokter\DashboardController as DokterDashboard;
use App\Http\Controllers\Perawat\DashboardController as PerawatDashboard;
use App\Http\Controllers\Resepsionis\DashboardController as ResepsionisDashboard;
use App\Http\Controllers\Pemilik\DashboardController as PemilikDashboard;

// Home page RSHP
Route::get('/', [HomeController::class, 'index'])->name('home');
// Halaman struktur organisasi
Route::get('/struktur', [StrukturController::class, 'index'])->name('struktur');
// Halaman visi dan misi
Route::get('/visi', [VisiController::class, 'index'])->name('visi');
// Halaman layanan
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
// Login dan Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Halaman Data Master Admin
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('admin.jenis-hewan');
    Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('admin.ras-hewan');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
    Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis');
    Route::get('/kode-terapi', [KodeTerapiController::class, 'index'])->name('admin.kode-terapi');
    Route::get('/pet', [PetController::class, 'index'])->name('admin.pet');
    Route::get('/role', [RoleController::class, 'index'])->name('admin.role');
    Route::get('/user', [UserController::class, 'index'])->name('admin.user');
});

Auth::routes();

// ========== ROUTE ROLE-BASED ==========
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'isDokter'])->group(function() {
    Route::get('/dokter/dashboard', [DokterDashboard::class, 'index'])->name('dokter.dashboard');
});

Route::middleware(['auth', 'isPerawat'])->group(function() {
    Route::get('/perawat/dashboard', [PerawatDashboard::class, 'index'])->name('perawat.dashboard');
});

Route::middleware(['auth', 'isResepsionis'])->group(function() {
    Route::get('/resepsionis/dashboard', [ResepsionisDashboard::class, 'index'])->name('resepsionis.dashboard');
});

Route::middleware(['auth', 'isPemilik'])->group(function() {
    Route::get('/pemilik/dashboard', [PemilikDashboard::class, 'index'])->name('pemilik.dashboard');
});

