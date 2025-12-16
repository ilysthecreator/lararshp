<?php
namespace App\Http\Controllers\Pemilik;
use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $pemilik = Auth::user()->pemilik;
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet');

        // Cari Rekam Medis yang reservasi dokternya memiliki pet milik user ini
        $rekamMedis = RekamMedis::whereHas('temuDokter', function($q) use ($petIds) {
                            $q->whereIn('idpet', $petIds);
                        })
                        ->with(['temuDokter.pet', 'dokter.user'])
                        ->latest('created_at')
                        ->paginate(10);

        return view('pemilik.riwayat.index', compact('rekamMedis'));
    }

    public function show($id)
    {
        // Detail Rekam Medis dengan validasi kepemilikan
        $pemilik = Auth::user()->pemilik;
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet')->toArray();

        $rekamMedis = RekamMedis::with(['temuDokter.pet', 'dokter.user', 'detailRekamMedis.kodeTindakan'])
                        ->where('idrekam_medis', $id)
                        ->firstOrFail();

        // Security check: Pastikan pet milik user yang login
        if (!in_array($rekamMedis->temuDokter->idpet, $petIds)) {
            abort(403, 'Akses ditolak. Hewan ini bukan milik Anda.');
        }

        return view('pemilik.riwayat.show', compact('rekamMedis'));
    }
}