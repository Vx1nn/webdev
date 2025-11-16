<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\StrukturController;
use App\Http\Controllers\Site\VisiController;
use App\Http\Controllers\Site\LayananController;
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
use App\Http\Controllers\Dokter\DokterController;
use App\Http\Controllers\Pemilik\PemilikController;
use App\Http\Controllers\Perawat\PerawatController;
use App\Http\Controllers\Resepsionis\ResepsionisController;

Route::get('/', function () {
    return view('site.home');
});
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

Route::middleware('isDokter')->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', fn() => view('dokter.dashboard'))->name('dashboard');
    Route::get('/rekam-medis', [DokterController::class, 'index'])->name('rekam-medis');
    Route::get('/rekam-medis/{id}', [DokterController::class, 'show'])->name('rekam-medis');
});

Route::prefix('perawat')->middleware(['isPerawat'])->group(function () {
    Route::get('/dashboard', fn() => view('perawat.dashboard'))->name('perawat.dashboard');
    Route::get('/rekam-medis/', [PerawatController::class, 'index'])->name('perawat.rekam-medis');
    Route::get('/rekam-medis/{id}', [PerawatController::class, 'show'])->name('perawat.rekam-medis');
});

Route::prefix('resepsionis')->middleware('isResepsionis')->group(function () {
    Route::get('/dashboard', fn() => redirect()->route('resepsionis.pemilik'))->name('resepsionis.dashboard');
    Route::get('/pemilik', [ResepsionisController::class, 'pemilik'])->name('resepsionis.pemilik');
    Route::get('/pets', [ResepsionisController::class, 'pets'])->name('resepsionis.pets');
    Route::get('/temu-dokter', [ResepsionisController::class, 'temudokter'])->name('resepsionis.temu-dokter');
});

Route::prefix('pemilik')->middleware('isPemilik')->group(function () {
    Route::get('/dashboard', fn() => view('pemilik.dashboard'))->name('pemilik.dashboard');
    Route::get('/rekam-medis', [PemilikController::class, 'rekam'])->name('pemilik.rekam-medis');
    Route::get('/rekam-medis/{id}', [PemilikController::class, 'show'])->name('pemilik.rekam-medis');
    Route::get('/pets', [PemilikController::class, 'pets'])->name('pemilik.pets');
    Route::get('/reservasi', [PemilikController::class, 'reservasi'])->name('pemilik.reservasi');
});

