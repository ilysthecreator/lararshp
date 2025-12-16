<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakan;
use App\Models\Pet;
use App\Models\RoleUser; // Ganti model Dokter jadi RoleUser
use App\Models\RekamMedis;
use App\Models\TemuDokter; // Perlu model ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function index()
    {
        // Load relasi lewat temuDokter karena struktur DB mengharuskannya
        $rekamMedis = RekamMedis::with(['temuDokter.pet.pemilik.user', 'dokter.user'])
                        ->latest()
                        ->paginate(10);
        return view('perawat.rekam-medis.index', compact('rekamMedis'));
    }

    public function create()
    {
        $pasien = Pet::with('pemilik.user')->get();
        
        // AMBIL DOKTER DARI ROLE_USER (Role ID 2 = Dokter)
        $dokters = RoleUser::with('user')->where('idrole', 2)->get(); 
        
        $tindakan = KodeTindakan::orderBy('deskripsi_tindakan_terapi')->get();
        
        return view('perawat.rekam-medis.create', compact('pasien', 'dokters', 'tindakan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'iddokter' => 'required|exists:role_user,idrole_user', // ID Dokter dari tabel role_user
            'anamnesa' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|array',
            'tindakan.*.id' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'tindakan.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // 1. Buat Reservasi (TemuDokter) "On The Spot" karena rekam medis butuh ini
            $temu = TemuDokter::create([
                'idpet' => $request->idpet,
                'idrole_user' => $request->iddokter, // Link ke dokter yang dipilih
                'waktu_daftar' => now(),
                'status' => '1', // Asumsi 1 = Selesai/Aktif
                'no_urut' => 0   // Dummy no urut
            ]);

            // 2. Buat Rekam Medis
            $rekamMedis = RekamMedis::create([
                'idreservasi_dokter' => $temu->idreservasi_dokter,
                'dokter_pemeriksa' => $request->iddokter,
                'anamnesa' => $request->anamnesa,
                'diagnosa' => $request->diagnosa,
                'temuan_klinis' => $request->keterangan, // Mapping keterangan -> temuan_klinis
                'created_at' => now(),
            ]);

            // 3. Simpan Detail Tindakan
            foreach ($request->tindakan as $item) {
                DetailRekamMedis::create([
                    'idrekam_medis' => $rekamMedis->idrekam_medis,
                    'idkode_tindakan_terapi' => $item['id'],
                    // Tabel detail_rekam_medis hanya punya kolom 'detail', bukan 'jumlah'/'keterangan'
                    // Kita simpan info jumlah/ket di kolom 'detail' sebagai string
                    'detail' => "Jumlah: {$item['jumlah']}. Ket: " . ($item['keterangan'] ?? '-'),
                ]);
            }

            DB::commit();
            return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam medis berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage())->withInput();
        }
    }
    
    // ... method show, edit, destroy sesuaikan logika di atas jika perlu ...
    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['temuDokter.pet', 'dokter.user', 'detailRekamMedis'])->findOrFail($id);
        return view('perawat.rekam-medis.show', compact('rekamMedis'));
    }

    public function destroy($id)
    {
        $rm = RekamMedis::findOrFail($id);
        $rm->detailRekamMedis()->delete();
        $rm->delete();
        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Data dihapus.');
    }
}