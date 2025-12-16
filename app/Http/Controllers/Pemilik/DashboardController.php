<?php
namespace App\Http\Controllers\Pemilik;
use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\TemuDokter;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pemilik = Auth::user()->pemilik;
        
        // Jika data pemilik belum lengkap
        if(!$pemilik) return abort(403, 'Data profil pemilik belum lengkap.');

        $totalPet = Pet::where('idpemilik', $pemilik->idpemilik)->count();
        
        // Ambil ID semua pet milik user ini
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet');
        
        // Jadwal dengan status 1 (Menunggu)
        $totalJadwal = TemuDokter::whereIn('idpet', $petIds)->where('status', '1')->count();
        
        // Riwayat Temu Dokter Terakhir
        $riwayatTerakhir = TemuDokter::whereIn('idpet', $petIds)
                            ->with('pet', 'dokterRoleUser.user')
                            ->latest('waktu_daftar')
                            ->take(5)->get();

        return view('pemilik.dashboard', compact('totalPet', 'totalJadwal', 'riwayatTerakhir'));
    }
}