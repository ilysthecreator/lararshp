<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakan;
use App\Models\Pet;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with('pet.pemilik.user')->latest()->paginate(10);

        return view('dokter.rekam-medis.index', compact('rekamMedis'));
    }
    public function show($id)
    {
        $rekamMedis = RekamMedis::with([
            'pet.pemilik.user',
            'pet.rasHewan.jenisHewan',
            'dokter.user',
            'detailRekamMedis.kodeTindakan'
        ])->findOrFail($id);
    
        // Memastikan relasi pet ada sebelum mengirim ke view
        if (!$rekamMedis->pet) {
            // Anda bisa redirect dengan pesan error atau menampilkan halaman 404
            return redirect()->route('dokter.rekam-medis.index')->with('error', 'Data hewan peliharaan untuk rekam medis ini tidak ditemukan.');
        }
    
        return view('dokter.rekam-medis.show', compact('rekamMedis'));
    }
    public function create()
    {
        $pasien = Pet::with('pemilik.user')->get();
        $tindakan = KodeTindakan::orderBy('deskripsi_tindakan_terapi')->get();
        return view('dokter.rekam-medis.create', compact('pasien', 'tindakan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'tgl_periksa' => 'required|date',
            'anamnesa' => 'required|string',
            'diagnosa' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tindakan' => 'required|array',
            'tindakan.*.id' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'tindakan.*.jumlah' => 'required|integer|min:1',
            'tindakan.*.keterangan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $dokter = Auth::user()->dokter;
            if (!$dokter) {
                return back()->with('error', 'Gagal menyimpan. Akun Anda tidak terhubung dengan data dokter.');
            }

            $rekamMedis = RekamMedis::create([
                'idpet' => $request->idpet,
                'iddokter' => $dokter->iddokter,
                'tgl_periksa' => $request->tgl_periksa,
                'anamnesa' => $request->anamnesa,
                'diagnosa' => $request->diagnosa,
                'keterangan' => $request->keterangan,
            ]);

            foreach ($request->tindakan as $tindakan) {
                DetailRekamMedis::create([
                    'idrekam_medis' => $rekamMedis->idrekam_medis,
                    'idkode_tindakan_terapi' => $tindakan['id'],
                    'jumlah' => $tindakan['jumlah'],
                    'keterangan' => $tindakan['keterangan'],
                ]);
            }

            DB::commit();

            return redirect()->route('dokter.rekam-medis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }
    }
    public function edit($id)
    {
        return redirect()->route('dokter.rekam-medis.index')->with('info', 'Fitur edit rekam medis sedang dalam pengembangan.');
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $rekamMedis = RekamMedis::findOrFail($id);
            $rekamMedis->detailRekamMedis()->delete();
            $rekamMedis->delete();

            DB::commit();
            return redirect()->route('dokter.rekam-medis.index')->with('success', 'Rekam medis berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}