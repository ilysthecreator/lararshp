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
        $dokters = RoleUser::with('user')->where('idrole', 2)->get();
        $pets = Pet::with('pemilik.user')->get();
        return view('resepsionis.temu-dokter.create', compact('dokters', 'pets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idrole_user' => 'required',
            'idpet' => 'required',
            'tgl_temu' => 'required|date',
            'jam_temu' => 'required',
        ]);

        $waktuDaftar = $request->tgl_temu . ' ' . $request->jam_temu;
        $countHariIni = TemuDokter::whereDate('waktu_daftar', $request->tgl_temu)->count();
        
        TemuDokter::create([
            'idrole_user' => $request->idrole_user,
            'idpet' => $request->idpet,
            'waktu_daftar' => $waktuDaftar,
            'no_urut' => $countHariIni + 1,
            'status' => '1',
        ]);

        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Jadwal berhasil dibuat.');
    }

    public function edit($id)
    {
        $temu = TemuDokter::findOrFail($id);
        $dokters = RoleUser::with('user')->where('idrole', 2)->get();
        $pets = Pet::with('pemilik.user')->get();
        
        // Memecah waktu_daftar untuk form
        $dt = Carbon::parse($temu->waktu_daftar);
        $tgl_temu = $dt->format('Y-m-d');
        $jam_temu = $dt->format('H:i');

        return view('resepsionis.temu-dokter.edit', compact('temu', 'dokters', 'pets', 'tgl_temu', 'jam_temu'));
    }

    public function update(Request $request, $id)
    {
        $temu = TemuDokter::findOrFail($id);

        // Jika hanya update status (dari tombol checklist dashboard/index)
        if ($request->has('status') && count($request->all()) == 3) { // token, method, status
            $temu->update(['status' => $request->status]);
            return back()->with('success', 'Status diperbarui');
        }

        // Jika update full data
        $request->validate([
            'idrole_user' => 'required',
            'idpet' => 'required',
            'tgl_temu' => 'required|date',
            'jam_temu' => 'required',
            'status' => 'required'
        ]);

        $waktuDaftar = $request->tgl_temu . ' ' . $request->jam_temu;
        
        $temu->update([
            'idrole_user' => $request->idrole_user,
            'idpet' => $request->idpet,
            'waktu_daftar' => $waktuDaftar,
            'status' => $request->status,
        ]);

        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        TemuDokter::findOrFail($id)->delete();
        return back()->with('success', 'Data dihapus');
    }
}