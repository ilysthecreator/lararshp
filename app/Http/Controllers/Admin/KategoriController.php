<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('idkategori', 'desc')->get();
        
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $this->validateKategori($request);

        // Format nama kategori
        $validatedData['nama_kategori'] = $this->formatNamaKategori($validatedData['nama_kategori']);

        // Simpan data
        Kategori::create($validatedData);

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Data kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        // Mengembalikan data dalam format JSON untuk digunakan oleh modal
        return response()->json($kategori);
    }

    public function update(Request $request, Kategori $kategori)
    {
        // Validasi data dengan pengecualian untuk data yang sedang diedit
        $validatedData = $this->validateKategori($request, $kategori->idkategori);

        // Format nama kategori
        $validatedData['nama_kategori'] = $this->formatNamaKategori($validatedData['nama_kategori']);

        // Update data
        $kategori->update($validatedData);

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Data kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        try {
            // Cek relasi sebelum menghapus
            if ($kategori->kodeTindakan()->exists()) {
                return redirect()->route('admin.kategori.index')
                                 ->with('error', 'Gagal menghapus! Data ini berelasi dengan data Kode Tindakan.');
            }

            $kategori->delete();

            return redirect()->route('admin.kategori.index')
                             ->with('success', 'Data kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori.index')
                             ->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    private function validateKategori(Request $request, $id = null)
    {
        $rules = [
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $id . ',idkategori',
        ];

        $messages = [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah terdaftar.',
        ];

        return $request->validate($rules, $messages);
    }

    private function formatNamaKategori($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}