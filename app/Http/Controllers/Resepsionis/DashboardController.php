<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPemilik = Pemilik::count();
        $totalPet = Pet::count();
        
        // Hitung User yang punya Role Dokter (idrole 2)
        $totalDokter = User::whereHas('roleUser', function($q) {
            $q->where('idrole', 2);
        })->count();
        
        $totalJanjiTemu = TemuDokter::count();

        // Fix: Order by 'waktu_daftar' sesuai kolom DB
        $janjiTemuTerbaru = TemuDokter::with(['pet.pemilik.user', 'dokterRoleUser.user'])
            ->orderBy('waktu_daftar', 'desc')
            ->take(10)
            ->get();

        return view('resepsionis.dashboard', compact('totalPemilik', 'totalPet', 'totalDokter', 'totalJanjiTemu', 'janjiTemuTerbaru'));
    }
}