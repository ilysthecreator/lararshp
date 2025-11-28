<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dokter;
use App\Http\Controllers\Dokter\ProfileController;
use App\Http\Controllers\Perawat;
use App\Http\Controllers\Resepsionis;
use App\Http\Controllers\Pemilik;


Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('/struktur-organisasi', [SiteController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

Auth::routes();

// Explicitly define the logout route to ensure it's handled correctly.
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logout', function () {
    return back();
});

Route::middleware(['auth'])->group(function () {

    Route::middleware(['isAdministrator'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/jenis-hewan', [Admin\JenisHewanController::class, 'index'])->name('jenis-hewan.index');
        Route::get('/jenis-hewan/create', [Admin\JenisHewanController::class, 'create'])->name('jenis-hewan.create');
        Route::post('/jenis-hewan', [Admin\JenisHewanController::class, 'store'])->name('jenis-hewan.store');
        Route::get('/jenis-hewan/{jenisHewan}/edit', [Admin\JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');
        Route::put('/jenis-hewan/{jenisHewan}', [Admin\JenisHewanController::class, 'update'])->name('jenis-hewan.update');
        Route::delete('/jenis-hewan/{jenisHewan}', [Admin\JenisHewanController::class, 'destroy'])->name('jenis-hewan.destroy');
        Route::get('/ras-hewan', [Admin\RasHewanController::class, 'index'])->name('ras-hewan.index');
        Route::get('/ras-hewan/create', [Admin\RasHewanController::class, 'create'])->name('ras-hewan.create');
        Route::post('/ras-hewan', [Admin\RasHewanController::class, 'store'])->name('ras-hewan.store');
        Route::get('/ras-hewan/{rasHewan}/edit', [Admin\RasHewanController::class, 'edit'])->name('ras-hewan.edit');
        Route::put('/ras-hewan/{rasHewan}', [Admin\RasHewanController::class, 'update'])->name('ras-hewan.update');
        Route::delete('/ras-hewan/{rasHewan}', [Admin\RasHewanController::class, 'destroy'])->name('ras-hewan.destroy');
        Route::get('/kategori', [Admin\KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [Admin\KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [Admin\KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{kategori}/edit', [Admin\KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{kategori}', [Admin\KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [Admin\KategoriController::class, 'destroy'])->name('kategori.destroy');
        Route::get('/kategori-klinis', [Admin\KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
        Route::get('/kategori-klinis/create', [Admin\KategoriKlinisController::class, 'create'])->name('kategori-klinis.create');
        Route::post('/kategori-klinis', [Admin\KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
        Route::get('/kategori-klinis/{kategoriKlinis}/edit', [Admin\KategoriKlinisController::class, 'edit'])->name('kategori-klinis.edit');
        Route::put('/kategori-klinis/{kategoriKlinis}', [Admin\KategoriKlinisController::class, 'update'])->name('kategori-klinis.update');
        Route::delete('/kategori-klinis/{kategoriKlinis}', [Admin\KategoriKlinisController::class, 'destroy'])->name('kategori-klinis.destroy');
        Route::get('/kode-tindakan', [Admin\KodeTindakanController::class, 'index'])->name('kode-tindakan.index');
        Route::get('/kode-tindakan/create', [Admin\KodeTindakanController::class, 'create'])->name('kode-tindakan.create');
        Route::post('/kode-tindakan', [Admin\KodeTindakanController::class, 'store'])->name('kode-tindakan.store');
        Route::get('/kode-tindakan/{kodeTindakan}/edit', [Admin\KodeTindakanController::class, 'edit'])->name('kode-tindakan.edit');
        Route::put('/kode-tindakan/{kodeTindakan}', [Admin\KodeTindakanController::class, 'update'])->name('kode-tindakan.update');
        Route::delete('/kode-tindakan/{kodeTindakan}', [Admin\KodeTindakanController::class, 'destroy'])->name('kode-tindakan.destroy');
        Route::get('/pemilik', [Admin\PemilikController::class, 'index'])->name('pemilik.index');
        Route::get('/pemilik/create', [Admin\PemilikController::class, 'create'])->name('pemilik.create');
        Route::post('/pemilik', [Admin\PemilikController::class, 'store'])->name('pemilik.store');
        Route::get('/pemilik/{pemilik}/edit', [Admin\PemilikController::class, 'edit'])->name('pemilik.edit');
        Route::put('/pemilik/{pemilik}', [Admin\PemilikController::class, 'update'])->name('pemilik.update');
        Route::delete('/pemilik/{pemilik}', [Admin\PemilikController::class, 'destroy'])->name('pemilik.destroy');
        Route::get('/pet', [Admin\PetController::class, 'index'])->name('pet.index');
        Route::get('/pet/create', [Admin\PetController::class, 'create'])->name('pet.create');
        Route::post('/pet', [Admin\PetController::class, 'store'])->name('pet.store');
        Route::get('/pet/{pet}/edit', [Admin\PetController::class, 'edit'])->name('pet.edit');
        Route::put('/pet/{pet}', [Admin\PetController::class, 'update'])->name('pet.update');
        Route::delete('/pet/{pet}', [Admin\PetController::class, 'destroy'])->name('pet.destroy');
        Route::get('/role', [Admin\RoleController::class, 'index'])->name('role.index');
        Route::post('/role', [Admin\RoleController::class, 'store'])->name('role.store');
        Route::get('/role/{role}/edit', [Admin\RoleController::class, 'edit'])->name('role.edit');
        Route::put('/role/{role}', [Admin\RoleController::class, 'update'])->name('role.update');
        Route::delete('/role/{role}', [Admin\RoleController::class, 'destroy'])->name('role.destroy');
        Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [Admin\UserController::class, 'create'])->name('users.create');
        Route::post('/users', [Admin\UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [Admin\UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [Admin\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [Admin\UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::middleware(['isDokter'])->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [Dokter\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/pasien', [Dokter\PasienController::class, 'index'])->name('pasien.index');

        // CRUD Rekam Medis
        Route::get('/rekam-medis', [Dokter\RekamMedisController::class, 'index'])->name('rekam-medis.index');
        Route::get('/rekam-medis/create', [Dokter\RekamMedisController::class, 'create'])->name('rekam-medis.create');
        Route::post('/rekam-medis', [Dokter\RekamMedisController::class, 'store'])->name('rekam-medis.store');
        Route::get('/rekam-medis/{id}', [Dokter\RekamMedisController::class, 'show'])->name('rekam-medis.show');
        Route::get('/rekam-medis/{id}/edit', [Dokter\RekamMedisController::class, 'edit'])->name('rekam-medis.edit');
        Route::delete('/rekam-medis/{id}', [Dokter\RekamMedisController::class, 'destroy'])->name('rekam-medis.destroy');

        // Rute untuk Profil Dokter
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::middleware(['isPerawat'])->prefix('perawat')->name('perawat.')->group(function () {
        Route::get('/dashboard', [Perawat\DashboardController::class, 'index'])->name('dashboard');
        // Tambahkan route perawat lainnya di sini
    });

    Route::middleware(['isResepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
        Route::get('/dashboard', [Resepsionis\DashboardController::class, 'index'])->name('dashboard');
        // Tambahkan route resepsionis lainnya di sini
    });

    Route::middleware(['isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/dashboard', [Pemilik\DashboardController::class, 'index'])->name('dashboard');
        // Tambahkan route pemilik lainnya di sini
    });
});