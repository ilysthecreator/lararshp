<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\RoleUser;
use App\Models\Pet;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TemuDokterController extends Controller
{
    public function index()
    {
        $temuDokter = TemuDokter::with(['dokterRoleUser.user', 'pet.pemilik.user'])
            ->orderBy('waktu_daftar', 'desc')
            ->paginate(10);
            
        return view('resepsionis.temu-dokter.index', compact('temuDokter'));
    }

    public function create()
    {
        // Ambil list dokter dari tabel role_user (idrole = 2 adalah Dokter)
        $dokters = RoleUser::with('user')->where('idrole', 2)->get();
        $pets = Pet::with('pemilik.user')->get();
        
        return view('resepsionis.temu-dokter.create', compact('dokters', 'pets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idrole_user' => 'required', // ID Dokter dari role_user
            'idpet' => 'required',
            'tgl_temu' => 'required|date',
            'jam_temu' => 'required',
            // 'keluhan' dihapus karena tidak ada di DB
        ]);

        // Gabungkan Tanggal dan Jam untuk kolom waktu_daftar
        $waktuDaftar = $request->tgl_temu . ' ' . $request->jam_temu;

        // Auto Generate No Urut (Per hari)
        $countHariIni = TemuDokter::whereDate('waktu_daftar', $request->tgl_temu)->count();
        $noUrut = $countHariIni + 1;

        TemuDokter::create([
            'idrole_user' => $request->idrole_user,
            'idpet' => $request->idpet,
            'waktu_daftar' => $waktuDaftar,
            'no_urut' => $noUrut,
            'status' => '1', // Asumsi: 1 = Menunggu/Aktif
        ]);

        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Jadwal berhasil dibuat. No Urut: ' . $noUrut);
    }
    
    public function update(Request $request, $id)
    {
        // Gunakan idreservasi_dokter
        $temu = TemuDokter::where('idreservasi_dokter', $id)->firstOrFail();
        $temu->update(['status' => $request->status]);
        return back()->with('success', 'Status diperbarui');
    }

    public function destroy($id)
    {
        $temu = TemuDokter::where('idreservasi_dokter', $id)->firstOrFail();
        $temu->delete();
        return back()->with('success', 'Data dihapus');
    }
}