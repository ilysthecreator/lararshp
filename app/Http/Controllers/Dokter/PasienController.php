<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Menampilkan halaman daftar pasien untuk dokter.
     */
    public function index()
    {
        $pasien = Pet::with('pemilik.user')->latest('idpet')->get();

        // 3. Kirim data $pasien ke view.
        return view('dokter.pasien.index', compact('pasien'));
    }
}