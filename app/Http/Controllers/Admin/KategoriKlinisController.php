<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::orderBy('idkategori_klinis', 'desc')->get();
        return view('admin.kategori-klinis.index', compact('kategoriKlinis'));
    }

    public function create()
    {
        return view('admin.kategori-klinis.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateKategoriKlinis($request);
        $validatedData['nama_kategori_klinis'] = $this->formatNama($validatedData['nama_kategori_klinis']);

        KategoriKlinis::create($validatedData);

        return redirect()->route('admin.kategori-klinis.index')
                         ->with('success', 'Data kategori klinis berhasil ditambahkan.');
    }

    public function edit(KategoriKlinis $kategoriKlinis)
    {
        return response()->json($kategoriKlinis);
    }

    public function update(Request $request, KategoriKlinis $kategoriKlinis)
    {
        $validatedData = $this->validateKategoriKlinis($request, $kategoriKlinis->idkategori_klinis);
        $validatedData['nama_kategori_klinis'] = $this->formatNama($validatedData['nama_kategori_klinis']);

        $kategoriKlinis->update($validatedData);

        return redirect()->route('admin.kategori-klinis.index')
                         ->with('success', 'Data kategori klinis berhasil diperbarui.');
    }

    public function destroy(KategoriKlinis $kategoriKlinis)
    {
        try {
            if ($kategoriKlinis->kodeTindakan()->exists()) {
                return redirect()->route('admin.kategori-klinis.index')
                                 ->with('error', 'Gagal menghapus! Data ini berelasi dengan data Kode Tindakan.');
            }

            $kategoriKlinis->delete();

            return redirect()->route('admin.kategori-klinis.index')
                             ->with('success', 'Data kategori klinis berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori-klinis.index')
                             ->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    private function validateKategoriKlinis(Request $request, $id = null)
    {
        $rules = [
            'nama_kategori_klinis' => 'required|string|max:100|unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis',
        ];

        $messages = [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 100 karakter.',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah terdaftar.',
        ];

        return $request->validate($rules, $messages);
    }

    private function formatNama($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}