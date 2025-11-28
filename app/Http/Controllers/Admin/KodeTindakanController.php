<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakan;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class KodeTindakanController extends Controller
{
    public function index()
    {
        $kodeTindakan = KodeTindakan::with(['kategori', 'kategoriKlinis'])
                                    ->orderBy('idkode_tindakan_terapi', 'desc')
                                    ->get();
        return view('admin.kode-tindakan.index', compact('kodeTindakan'));
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $kategoriKlinis = KategoriKlinis::orderBy('nama_kategori_klinis', 'asc')->get();
        return view('admin.kode-tindakan.create', compact('kategori', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateKodeTindakan($request);
        $validatedData['kode'] = strtoupper(trim($validatedData['kode']));

        KodeTindakan::create($validatedData);

        return redirect()->route('admin.kode-tindakan.index')
                         ->with('success', 'Data kode tindakan berhasil ditambahkan.');
    }

    public function edit(KodeTindakan $kodeTindakan)
    {
        return response()->json($kodeTindakan);
    }

    public function update(Request $request, KodeTindakan $kodeTindakan)
    {
        $validatedData = $this->validateKodeTindakan($request, $kodeTindakan->idkode_tindakan_terapi);
        $validatedData['kode'] = strtoupper(trim($validatedData['kode']));

        $kodeTindakan->update($validatedData);

        return redirect()->route('admin.kode-tindakan.index')
                         ->with('success', 'Data kode tindakan berhasil diperbarui.');
    }

    public function destroy(KodeTindakan $kodeTindakan)
    {
        try {
            // Tambahkan pengecekan relasi di sini jika ada, contoh:
            // if ($kodeTindakan->rekamMedisDetail()->exists()) {
            //     return redirect()->route('admin.kode-tindakan.index')
            //                      ->with('error', 'Gagal menghapus! Data ini berelasi dengan data lain.');
            // }

            $kodeTindakan->delete();

            return redirect()->route('admin.kode-tindakan.index')
                             ->with('success', 'Data kode tindakan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kode-tindakan.index')
                             ->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    private function validateKodeTindakan(Request $request, $id = null)
    {
        $rules = [
            'kode' => 'required|string|max:20|unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
            'deskripsi_tindakan_terapi' => 'required|string|max:255',
        ];

        $messages = [
            'kode.required' => 'Kode tindakan wajib diisi.',
            'kode.unique' => 'Kode tindakan sudah terdaftar.',
            'idkategori.required' => 'Kategori wajib dipilih.',
            'idkategori_klinis.required' => 'Kategori klinis wajib dipilih.',
            'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi.',
        ];

        return $request->validate($rules, $messages);
    }
}