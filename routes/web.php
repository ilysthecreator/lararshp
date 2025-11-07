<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('/struktur-organisasi', [SiteController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

Auth::routes();
Route::middleware(['auth'])->group(function () {

    Route::middleware(['isAdministrator'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');
        Route::get('/jenis-hewan/create', [JenisHewanController::class, 'create'])->name('jenis-hewan.create');
        Route::post('/jenis-hewan', [JenisHewanController::class, 'store'])->name('jenis-hewan.store');
        Route::get('/jenis-hewan/{jenisHewan}/edit', [JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');
        Route::put('/jenis-hewan/{jenisHewan}', [JenisHewanController::class, 'update'])->name('jenis-hewan.update');
        Route::delete('/jenis-hewan/{jenisHewan}', [JenisHewanController::class, 'destroy'])->name('jenis-hewan.destroy');
        Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras-hewan.index');
        Route::get('/ras-hewan/create', [RasHewanController::class, 'create'])->name('ras-hewan.create');
        Route::post('/ras-hewan', [RasHewanController::class, 'store'])->name('ras-hewan.store');
        Route::get('/ras-hewan/{rasHewan}/edit', [RasHewanController::class, 'edit'])->name('ras-hewan.edit');
        Route::put('/ras-hewan/{rasHewan}', [RasHewanController::class, 'update'])->name('ras-hewan.update');
        Route::delete('/ras-hewan/{rasHewan}', [RasHewanController::class, 'destroy'])->name('ras-hewan.destroy');
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
        Route::get('/kode-tindakan', [KodeTindakanController::class, 'index'])->name('kode-tindakan.index');
        Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
        Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });

    Route::middleware(['isDokter'])->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Dokter\DashboardController::class, 'index'])->name('dashboard');
        // Tambahkan route dokter lainnya di sini
    });

    Route::middleware(['isPerawat'])->prefix('perawat')->name('perawat.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Perawat\DashboardController::class, 'index'])->name('dashboard');
        // Tambahkan route perawat lainnya di sini
    });

    Route::middleware(['isResepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Tambahkan route resepsionis lainnya di sini
    });

    Route::middleware(['isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Pemilik\DashboardController::class, 'index'])->name('dashboard');
        // Tambahkan route pemilik lainnya di sini
    });
});