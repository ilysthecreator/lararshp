<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewan = JenisHewan::orderBy('idjenis_hewan', 'desc')->get();
        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        return view('admin.jenis-hewan.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $this->validateJenisHewan($request);

        // Format nama jenis
        $validatedData['nama_jenis_hewan'] = $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']);

        // Simpan data menggunakan helper
        $this->createJenisHewan($validatedData);

        return redirect()->route('admin.jenis-hewan.index')
                         ->with('success', 'Data jenis hewan berhasil ditambahkan.');
    }

    public function edit(JenisHewan $jenisHewan)
    {
        // Mengembalikan data dalam format JSON untuk digunakan oleh modal
        return response()->json($jenisHewan);
    }

    public function update(Request $request, JenisHewan $jenisHewan)
    {
        // Validasi data dengan pengecualian untuk data yang sedang diedit
        $validatedData = $this->validateJenisHewan($request, $jenisHewan->idjenis_hewan);

        // Format nama jenis
        $validatedData['nama_jenis_hewan'] = $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']);

        // Update data
        $jenisHewan->update($validatedData);

        return redirect()->route('admin.jenis-hewan.index')
                         ->with('success', 'Data jenis hewan berhasil diperbarui.');
    }

    public function destroy(JenisHewan $jenisHewan)
    {
        try {
            // Cek relasi sebelum menghapus
            if ($jenisHewan->rasHewan()->exists()) {
                return redirect()->route('admin.jenis-hewan.index')
                                 ->with('error', 'Gagal menghapus! Data ini berelasi dengan data Ras Hewan.');
            }

            if ($jenisHewan->pets()->exists()) {
                return redirect()->route('admin.jenis-hewan.index')
                                 ->with('error', 'Gagal menghapus! Data ini berelasi dengan data Pet.');
            }

            $jenisHewan->delete();

            return redirect()->route('admin.jenis-hewan.index')
                             ->with('success', 'Data jenis hewan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.jenis-hewan.index')
                             ->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    private function validateJenisHewan(Request $request, $id = null)
    {
        $rules = [
            'nama_jenis_hewan' => 'required|string|max:100',
        ];

        if ($id) {
            $rules['nama_jenis_hewan'] .= '|unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan';
        } else {
            $rules['nama_jenis_hewan'] .= '|unique:jenis_hewan,nama_jenis_hewan';
        }

        $messages = [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 100 karakter.',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah terdaftar.',
        ];

        return $request->validate($rules, $messages);
    }

    private function formatNamaJenisHewan($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }

    private function createJenisHewan($data)
    {
        return JenisHewan::create([
            'nama_jenis_hewan' => $data['nama_jenis_hewan'],
        ]);
    }
}