<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\VisiController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AuthController;
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

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        
        Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');
        Route::get('/jenis-hewan/create', [JenisHewanController::class, 'create'])->name('jenis-hewan.create');
        Route::post('/jenis-hewan/store', [JenisHewanController::class, 'store'])->name('jenis-hewan.store');

        Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras-hewan.index');
        Route::get('/ras-hewan/create', [RasHewanController::class, 'create'])->name('ras-hewan.create');
        Route::post('/ras-hewan/store', [RasHewanController::class, 'store'])->name('ras-hewan.store');

        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');

        Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
        Route::get('/kategori-klinis/create', [KategoriKlinisController::class, 'create'])->name('kategori-klinis.create');
        Route::post('/kategori-klinis/store', [KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');

        Route::get('/kode-terapi', [KodeTerapiController::class, 'index'])->name('kode-terapi.index');
        Route::get('/kode-terapi/create', [KodeTerapiController::class, 'create'])->name('kode-terapi.create');
        Route::post('/kode-terapi/store', [KodeTerapiController::class, 'store'])->name('kode-terapi.store');

        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
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

