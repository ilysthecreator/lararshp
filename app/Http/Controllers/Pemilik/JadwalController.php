<?php
namespace App\Http\Controllers\Pemilik;
use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\TemuDokter;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $pemilik = Auth::user()->pemilik;
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet');

        $jadwal = TemuDokter::whereIn('idpet', $petIds)
                    ->with(['pet.rasHewan', 'dokterRoleUser.user'])
                    ->orderBy('waktu_daftar', 'desc')
                    ->paginate(10);

        return view('pemilik.jadwal.index', compact('jadwal'));
    }
}