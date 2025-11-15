<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\VisiController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\{
    DashboardController,
    JenisHewanController,
    RasHewanController,
    KategoriController,
    KategoriKlinisController,
    KodeTindakanTerapiController,
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
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Auth::routes();

Route::middleware('isAdmin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::post('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/delete/{user}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::post('/role/edit/{role}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role/delete/{role}', [RoleController::class, 'delete'])->name('role.delete');
    Route::post('/user/{user}/role/{role}/toggle', [UserController::class, 'toggleRole'])->name('user.role.toggle');

    Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
    Route::post('/pet/store', [PetController::class, 'store'])->name('pet.store');
    Route::post('/pet/edit/{pet}', [PetController::class, 'edit'])->name('pet.edit');
    Route::post('/pet/delete/{pet}', [PetController::class, 'delete'])->name('pet.delete');

    Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');
    Route::post('/jenis-hewan/store', [JenisHewanController::class, 'store'])->name('jenis-hewan.store');
    Route::post('/jenis-hewan/edit/{jenis}', [JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');
    Route::post('/jenis-hewan/delete/{jenis}', [JenisHewanController::class, 'delete'])->name('jenis-hewan.delete');

    Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras-hewan.index');
    Route::post('/ras-hewan/store', [RasHewanController::class, 'store'])->name('ras-hewan.store');
    Route::post('/ras-hewan/edit/{ras}', [RasHewanController::class, 'edit'])->name('ras-hewan.edit');
    Route::post('/ras-hewan/delete/{ras}', [RasHewanController::class, 'delete'])->name('ras-hewan.delete');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::post('/kategori/edit/{kategori}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('/kategori/delete/{kategori}', [KategoriController::class, 'delete'])->name('kategori.delete');

    Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
    Route::post('/kategori-klinis/store', [KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
    Route::post('/kategori-klinis/edit/{kategori}', [KategoriKlinisController::class, 'edit'])->name('kategori-klinis.edit');
    Route::post('/kategori-klinis/delete/{kategori}', [KategoriKlinisController::class, 'delete'])->name('kategori-klinis.delete');

    Route::get('/kode-tindakan', [KodeTindakanTerapiController::class, 'index'])->name('kode-tindakan.index');
    Route::post('/kode-tindakan/store', [KodeTindakanTerapiController::class, 'store'])->name('kode-tindakan.store');
    Route::post('/kode-tindakan/edit/{kode}', [KodeTindakanTerapiController::class, 'edit'])->name('kode-tindakan.edit');
    Route::post('/kode-tindakan/delete/{kode}', [KodeTindakanTerapiController::class, 'delete'])->name('kode-tindakan.delete');
});


Route::middleware(['isDokter'])->group(function() {
    Route::get('/dokter/dashboard', [DokterDashboard::class, 'index'])->name('dokter.dashboard');
});

Route::middleware(['isPerawat'])->group(function() {
    Route::get('/perawat/dashboard', [PerawatDashboard::class, 'index'])->name('perawat.dashboard');
});

Route::middleware(['isResepsionis'])->group(function() {
    Route::get('/resepsionis/dashboard', [ResepsionisDashboard::class, 'index'])->name('resepsionis.dashboard');
});

Route::middleware(['isPemilik'])->group(function() {
    Route::get('/pemilik/dashboard', [PemilikDashboard::class, 'index'])->name('pemilik.dashboard');
});

