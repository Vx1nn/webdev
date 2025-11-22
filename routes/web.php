<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\StrukturController;
use App\Http\Controllers\Site\VisiController;
use App\Http\Controllers\Site\LayananController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ {
    DashboardController,
    JenisHewanController,
    RasHewanController,
    KategoriController,
    KategoriKlinisController,
    KodeTindakanTerapiController,
    PetController,
    RoleController,
    UserController,
};


Route::get('/', action: function () {
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
	Route::post('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
	Route::post('/role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
	Route::post('/user/{user}/role/{id}/toggle', [UserController::class, 'toggleRole'])->name('user.role.toggle');

	Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
	Route::post('/pet/store', [PetController::class, 'store'])->name('pet.store');
	Route::post('/pet/edit/{pet}', [PetController::class, 'edit'])->name('pet.edit');
	Route::post('/pet/delete/{pet}', [PetController::class, 'delete'])->name('pet.delete');

	Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');
	Route::post('/jenis-hewan/store', [JenisHewanController::class, 'store'])->name('jenis-hewan.store');
	Route::post('/jenis-hewan/edit/{id}', [JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');
	Route::post('/jenis-hewan/delete/{id}', [JenisHewanController::class, 'delete'])->name('jenis-hewan.delete');

	Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras-hewan.index');
	Route::post('/ras-hewan/store', [RasHewanController::class, 'store'])->name('ras-hewan.store');
	Route::post('/ras-hewan/edit/{ras}', [RasHewanController::class, 'edit'])->name('ras-hewan.edit');
	Route::post('/ras-hewan/delete/{ras}', [RasHewanController::class, 'delete'])->name('ras-hewan.delete');

	Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
	Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
	Route::post('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
	Route::post('/kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');

	Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
	Route::post('/kategori-klinis/store', [KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
	Route::post('/kategori-klinis/edit/{kategori}', [KategoriKlinisController::class, 'edit'])->name('kategori-klinis.edit');
	Route::post('/kategori-klinis/delete/{kategori}', [KategoriKlinisController::class, 'delete'])->name('kategori-klinis.delete');

	Route::get('/kode-tindakan', [KodeTindakanTerapiController::class, 'index'])->name('kode-tindakan.index');
	Route::post('/kode-tindakan/store', [KodeTindakanTerapiController::class, 'store'])->name('kode-tindakan.store');
	Route::post('/kode-tindakan/edit/{kode}', [KodeTindakanTerapiController::class, 'edit'])->name('kode-tindakan.edit');
	Route::post('/kode-tindakan/delete/{kode}', [KodeTindakanTerapiController::class, 'delete'])->name('kode-tindakan.delete');

	Route::get('/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('pemilik.index');
	Route::post('/pemilik/store', [App\Http\Controllers\Admin\PemilikController::class, 'store'])->name('pemilik.store');
	Route::post('/pemilik/edit/{id}', [App\Http\Controllers\Admin\PemilikController::class, 'edit'])->name('pemilik.edit');
	Route::post('/pemilik/delete/{id}', [App\Http\Controllers\Admin\PemilikController::class, 'delete'])->name('pemilik.delete');

	Route::get('/dokter', [App\Http\Controllers\Admin\DokterController::class, 'index'])->name('dokter.index');
	Route::post('/dokter/store', [App\Http\Controllers\Admin\DokterController::class, 'store'])->name('dokter.store');
	Route::post('/dokter/edit/{id}', [App\Http\Controllers\Admin\DokterController::class, 'edit'])->name('dokter.edit');
	Route::post('/dokter/delete/{id}', [App\Http\Controllers\Admin\DokterController::class, 'delete'])->name('dokter.delete');

	Route::get('/perawat', [App\Http\Controllers\Admin\PerawatController::class, 'index'])->name('perawat.index');
	Route::post('/perawat/store', [App\Http\Controllers\Admin\PerawatController::class, 'store'])->name('perawat.store');
	Route::post('/perawat/edit/{id}', [App\Http\Controllers\Admin\PerawatController::class, 'edit'])->name('perawat.edit');
	Route::post('/perawat/delete/{id}', [App\Http\Controllers\Admin\PerawatController::class, 'delete'])->name('perawat.delete');

	Route::get('/rekam-medis', [App\Http\Controllers\Admin\RekamMedisController::class, 'index'])->name('rekam-medis.index');
	Route::get('/rekam-medis/{id}', [App\Http\Controllers\Admin\RekamMedisController::class, 'show'])->name('rekam-medis.show');
	Route::post('/rekam-medis/delete/{id}', [App\Http\Controllers\Admin\RekamMedisController::class, 'delete'])->name('rekam-medis.delete');

	Route::get('/temu-dokter', [App\Http\Controllers\Admin\TemuDokterController::class, 'index'])->name('temu-dokter.index');
	Route::post('/temu-dokter/store', [App\Http\Controllers\Admin\TemuDokterController::class, 'store'])->name('temu-dokter.store');
	Route::post('/temu-dokter/edit/{id}', [App\Http\Controllers\Admin\TemuDokterController::class, 'edit'])->name('temu-dokter.edit');
	Route::post('/temu-dokter/delete/{id}', [App\Http\Controllers\Admin\TemuDokterController::class, 'delete'])->name('temu-dokter.delete');
});

Route::middleware('isDokter')->prefix('dokter')->name('dokter.')->group(function () {
	Route::get('/dashboard', [App\Http\Controllers\Dokter\DashboardController::class, 'index'])->name('dashboard');
	Route::get('/pasien', [App\Http\Controllers\Dokter\DokterController::class, 'viewPasien'])->name('pasien.index');
	
    Route::get('/rekam-medis', [App\Http\Controllers\Dokter\RekamMedisController::class, 'index'])->name('rekam-medis.index');
	Route::get('/rekam-medis/{id}', [App\Http\Controllers\Dokter\RekamMedisController::class, 'show'])->name('rekam-medis.show');
	Route::post('/rekam-medis/{id}/detail/store', [App\Http\Controllers\Dokter\RekamMedisController::class, 'storeDetail'])->name('rekam-medis.detail.store');
	Route::post('/rekam-medis/{id}/detail/edit/{detailId}', [App\Http\Controllers\Dokter\RekamMedisController::class, 'editDetail'])->name('rekam-medis.detail.edit');
	Route::post('/rekam-medis/{id}/detail/delete/{detailId}', [App\Http\Controllers\Dokter\RekamMedisController::class, 'deleteDetail'])->name('rekam-medis.detail.delete');
});

Route::middleware('isPerawat')->prefix('perawat')->name('perawat.')->group(function () {
	Route::get('/dashboard', [App\Http\Controllers\Perawat\DashboardController::class, 'index'])->name('dashboard');
	
    Route::get('/pasien', [App\Http\Controllers\Perawat\PerawatController::class, 'viewPasien'])->name('pasien.index');
	
    Route::get('/rekam-medis', [App\Http\Controllers\Perawat\RekamMedisController::class, 'index'])->name('rekam-medis.index');
	Route::post('/rekam-medis/store', [App\Http\Controllers\Perawat\RekamMedisController::class, 'store'])->name('rekam-medis.store');
	Route::post('/rekam-medis/edit/{id}', [App\Http\Controllers\Perawat\RekamMedisController::class, 'edit'])->name('rekam-medis.edit');
	Route::post('/rekam-medis/delete/{id}', [App\Http\Controllers\Perawat\RekamMedisController::class, 'delete'])->name('rekam-medis.delete');
	Route::get('/rekam-medis/{id}', [App\Http\Controllers\Perawat\RekamMedisController::class, 'show'])->name('rekam-medis.show');
});

Route::middleware('isResepsionis')->prefix('resepsionis')->name('resepsionis.')->group(function () {
	Route::get('/dashboard', [App\Http\Controllers\Resepsionis\DashboardController::class, 'index'])->name('dashboard');
	
    Route::get('/pemilik', [App\Http\Controllers\Resepsionis\PemilikController::class, 'index'])->name('pemilik.index');
	Route::post('/pemilik/store', [App\Http\Controllers\Resepsionis\PemilikController::class, 'store'])->name('pemilik.store');
	Route::post('/pemilik/edit/{pemilik}', [App\Http\Controllers\Resepsionis\PemilikController::class, 'edit'])->name('pemilik.edit');
	Route::post('/pemilik/delete/{pemilik}', [App\Http\Controllers\Resepsionis\PemilikController::class, 'delete'])->name('pemilik.delete');

	Route::get('/pet', [App\Http\Controllers\Resepsionis\PetController::class, 'index'])->name('pet.index');
	Route::post('/pet/store', [App\Http\Controllers\Resepsionis\PetController::class, 'store'])->name('pet.store');
	Route::post('/pet/edit/{pet}', [App\Http\Controllers\Resepsionis\PetController::class, 'edit'])->name('pet.edit');
	Route::post('/pet/delete/{pet}', [App\Http\Controllers\Resepsionis\PetController::class, 'delete'])->name('pet.delete');

	Route::get('/temu-dokter', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'index'])->name('temu-dokter.index');
	Route::post('/temu-dokter/store', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'store'])->name('temu-dokter.store');
	Route::post('/temu-dokter/edit/{id}', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'edit'])->name('temu-dokter.edit');
	Route::post('/temu-dokter/delete/{id}', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'delete'])->name('temu-dokter.delete');
});

Route::middleware('isPemilik')->prefix('pemilik')->name('pemilik.')->group(function () {
	Route::get('/dashboard', [App\Http\Controllers\Pemilik\DashboardController::class, 'index'])->name('dashboard');

	Route::get('/temu-dokter', [App\Http\Controllers\Pemilik\ReservasiController::class, 'index'])->name('temu-dokter.index');
	
    Route::get('/rekam-medis', [App\Http\Controllers\Pemilik\RekamMedisController::class, 'index'])->name('rekam-medis.index');
	Route::get('/rekam-medis/{id}', [App\Http\Controllers\Pemilik\RekamMedisController::class, 'show'])->name('rekam-medis.show');
	
    Route::get('/pet', [App\Http\Controllers\Pemilik\PetController::class, 'index'])->name('pet.index');
});

Route::middleware('auth')->get('/dashboard', [App\Http\Controllers\Site\DashboardController::class, 'index'])->name('dashboard');
Route::middleware('auth')->get('/profile', [App\Http\Controllers\Site\ProfileController::class, 'index'])->name('profile');