<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

// Site Routes (Public)
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/home', [SiteController::class, 'home'])->name('home');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('/struktur-organisasi', [SiteController::class, 'strukturOrganisasi'])->name('struktur-organisasi');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected by auth & admin middleware)
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Jenis Hewan Routes (CRUD Complete)
    Route::controller(JenisHewanController::class)->group(function () {
        Route::get('jenis-hewan', 'index')->name('jenis-hewan.index');
        Route::get('jenis-hewan/create', 'create')->name('jenis-hewan.create');
        Route::post('jenis-hewan', 'store')->name('jenis-hewan.store');
        Route::get('jenis-hewan/{id}/edit', 'edit')->name('jenis-hewan.edit');
        Route::put('jenis-hewan/{id}', 'update')->name('jenis-hewan.update');
        Route::delete('jenis-hewan/{id}', 'destroy')->name('jenis-hewan.destroy');
    });
    
    // Ras Hewan Routes
    Route::controller(RasHewanController::class)->group(function () {
        Route::get('ras-hewan', 'index')->name('ras-hewan.index');
        Route::get('ras-hewan/create', 'create')->name('ras-hewan.create');
        Route::post('ras-hewan', 'store')->name('ras-hewan.store');
        Route::get('ras-hewan/{id}/edit', 'edit')->name('ras-hewan.edit');
        Route::put('ras-hewan/{id}', 'update')->name('ras-hewan.update');
        Route::delete('ras-hewan/{id}', 'destroy')->name('ras-hewan.destroy');
    });
    
    // Kategori Routes
    Route::controller(KategoriController::class)->group(function () {
        Route::get('kategori', 'index')->name('kategori.index');
        Route::get('kategori/create', 'create')->name('kategori.create');
        Route::post('kategori', 'store')->name('kategori.store');
        Route::get('kategori/{id}/edit', 'edit')->name('kategori.edit');
        Route::put('kategori/{id}', 'update')->name('kategori.update');
        Route::delete('kategori/{id}', 'destroy')->name('kategori.destroy');
    });
    
    // Kategori Klinis Routes
    Route::controller(KategoriKlinisController::class)->group(function () {
        Route::get('kategori-klinis', 'index')->name('kategori-klinis.index');
        Route::get('kategori-klinis/create', 'create')->name('kategori-klinis.create');
        Route::post('kategori-klinis', 'store')->name('kategori-klinis.store');
        Route::get('kategori-klinis/{id}/edit', 'edit')->name('kategori-klinis.edit');
        Route::put('kategori-klinis/{id}', 'update')->name('kategori-klinis.update');
        Route::delete('kategori-klinis/{id}', 'destroy')->name('kategori-klinis.destroy');
    });
    
    // Kode Tindakan Routes
    Route::controller(KodeTindakanController::class)->group(function () {
        Route::get('kode-tindakan', 'index')->name('kode-tindakan.index');
        Route::get('kode-tindakan/create', 'create')->name('kode-tindakan.create');
        Route::post('kode-tindakan', 'store')->name('kode-tindakan.store');
        Route::get('kode-tindakan/{id}/edit', 'edit')->name('kode-tindakan.edit');
        Route::put('kode-tindakan/{id}', 'update')->name('kode-tindakan.update');
        Route::delete('kode-tindakan/{id}', 'destroy')->name('kode-tindakan.destroy');
    });
    
    // Pet Routes
    Route::controller(PetController::class)->group(function () {
        Route::get('pet', 'index')->name('pet.index');
        Route::get('pet/create', 'create')->name('pet.create');
        Route::post('pet', 'store')->name('pet.store');
        Route::get('pet/{id}/edit', 'edit')->name('pet.edit');
        Route::put('pet/{id}', 'update')->name('pet.update');
        Route::delete('pet/{id}', 'destroy')->name('pet.destroy');
    });
    
    // Pemilik Routes
    Route::controller(PemilikController::class)->group(function () {
        Route::get('pemilik', 'index')->name('pemilik.index');
        Route::get('pemilik/create', 'create')->name('pemilik.create');
        Route::post('pemilik', 'store')->name('pemilik.store');
        Route::get('pemilik/{id}/edit', 'edit')->name('pemilik.edit');
        Route::put('pemilik/{id}', 'update')->name('pemilik.update');
        Route::delete('pemilik/{id}', 'destroy')->name('pemilik.destroy');
    });
    
    // Role Routes
    Route::controller(RoleController::class)->group(function () {
        Route::get('role', 'index')->name('role.index');
        Route::get('role/create', 'create')->name('role.create');
        Route::post('role', 'store')->name('role.store');
        Route::get('role/{id}/edit', 'edit')->name('role.edit');
        Route::put('role/{id}', 'update')->name('role.update');
        Route::delete('role/{id}', 'destroy')->name('role.destroy');
    });
    
    // Users Routes
    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users.index');
        Route::get('users/create', 'create')->name('users.create');
        Route::post('users', 'store')->name('users.store');
        Route::get('users/{id}/edit', 'edit')->name('users.edit');
        Route::put('users/{id}', 'update')->name('users.update');
        Route::delete('users/{id}', 'destroy')->name('users.destroy');
    });
});