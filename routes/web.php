<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- Imports Controller ---

// Site & Auth
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanController;
use App\Http\Controllers\Admin\PemilikController as AdminPemilikController;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

// Dokter Controllers
use App\Http\Controllers\Dokter\DashboardController as DokterDashboard;
use App\Http\Controllers\Dokter\PasienController;
use App\Http\Controllers\Dokter\ProfileController;
use App\Http\Controllers\Dokter\RekamMedisController;

// Perawat Controllers
use App\Http\Controllers\Perawat\DashboardController as PerawatDashboard;

// Resepsionis Controllers
use App\Http\Controllers\Resepsionis\DashboardController as ResepsionisDashboard;
use App\Http\Controllers\Resepsionis\PemilikController as ResepsionisPemilikController;
use App\Http\Controllers\Resepsionis\PetController as ResepsionisPetController;
use App\Http\Controllers\Resepsionis\TemuDokterController;

// Pemilik (User/Customer) Controllers
use App\Http\Controllers\Pemilik\DashboardController as PemilikDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Public Routes ---
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('/struktur-organisasi', [SiteController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

// --- Auth Routes ---
Auth::routes();

// Custom Logout Route (Fix untuk masalah logout method POST/GET)
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logout', function () {
    return back();
});

// --- Authenticated Routes ---
Route::middleware(['auth'])->group(function () {
    Route::middleware(['isAdministrator'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Master Data User & Role
        Route::resource('user', UserController::class);
        Route::resource('role', RoleController::class);

        // Data Klinik (Admin View)
        Route::resource('pemilik', AdminPemilikController::class);
        Route::resource('pet', AdminPetController::class);

        // Data Referensi Medis
        Route::resource('jenis-hewan', JenisHewanController::class);
        Route::resource('ras-hewan', RasHewanController::class);
        Route::resource('kategori', KategoriController::class); // Kategori Obat
        Route::resource('kategori-klinis', KategoriKlinisController::class);
        Route::resource('kode-tindakan', KodeTindakanController::class);
    });

    Route::middleware(['isDokter'])->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [DokterDashboard::class, 'index'])->name('dashboard');
        Route::resource('pasien', PasienController::class)->only(['index', 'show']);
        Route::resource('rekam-medis', RekamMedisController::class);

        // Profile Dokter
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::middleware(['isPerawat'])->prefix('perawat')->name('perawat.')->group(function () {
        Route::get('/dashboard', [PerawatDashboard::class, 'index'])->name('dashboard');
        // Tambahkan route khusus perawat lainnya di sini jika ada
    });

    Route::middleware(['isResepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
        Route::get('/dashboard', [ResepsionisDashboard::class, 'index'])->name('dashboard');
        Route::resource('pemilik', ResepsionisPemilikController::class);
        Route::resource('pet', ResepsionisPetController::class);
        Route::resource('temu-dokter', TemuDokterController::class);
    });

    Route::middleware(['isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/dashboard', [PemilikDashboard::class, 'index'])->name('dashboard');
        // Tambahkan route riwayat berobat hewan sendiri di sini
    });

});