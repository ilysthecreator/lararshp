<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemilik = Pemilik::count();
        $totalPet = Pet::count();
        $totalDokter = \App\Models\User::whereHas('roleUser', fn($q) => $q->where('idrole', 2))->count(); // Role ID 2 for Dokter
        $totalJanjiTemu = TemuDokter::count();

        $janjiTemuTerbaru = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])->orderBy('tgl_temu', 'desc')->orderBy('jam_temu', 'desc')->take(10)->get();

        return view('resepsionis.dashboard', compact('totalPemilik', 'totalPet', 'totalDokter', 'totalJanjiTemu', 'janjiTemuTerbaru'));
    }
}