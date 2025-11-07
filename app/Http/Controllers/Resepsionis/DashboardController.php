<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk Resepsionis.
     */
    public function index()
    {
        // Mengambil data pemilik untuk ditampilkan
        $pemiliks = Pemilik::with('user')->latest()->get();

        return view('resepsionis.dashboard', compact('pemiliks'));
    }
}