<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')->orderBy('idras_hewan', 'desc')->get();
        return view('admin.ras-hewan.index', compact('rasHewan'));
    }

    public function create()
    {
        $jenisHewan = JenisHewan::orderBy('nama_jenis_hewan', 'asc')->get();
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRasHewan($request);
        $validatedData['nama_ras'] = $this->formatNamaRas($validatedData['nama_ras']);

        RasHewan::create($validatedData);

        return redirect()->route('admin.ras-hewan.index')
                         ->with('success', 'Data ras hewan berhasil ditambahkan.');
    }

    public function edit(RasHewan $rasHewan)
    {
        return response()->json($rasHewan);
    }

    public function update(Request $request, RasHewan $rasHewan)
    {
        $validatedData = $this->validateRasHewan($request, $rasHewan->idras_hewan);
        $validatedData['nama_ras'] = $this->formatNamaRas($validatedData['nama_ras']);

        $rasHewan->update($validatedData);

        return redirect()->route('admin.ras-hewan.index')
                         ->with('success', 'Data ras hewan berhasil diperbarui.');
    }

    public function destroy(RasHewan $rasHewan)
    {
        try {
            if ($rasHewan->pets()->exists()) {
                return redirect()->route('admin.ras-hewan.index')
                                 ->with('error', 'Gagal menghapus! Data ini berelasi dengan data Pet.');
            }

            $rasHewan->delete();

            return redirect()->route('admin.ras-hewan.index')
                             ->with('success', 'Data ras hewan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.ras-hewan.index')
                             ->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    private function validateRasHewan(Request $request, $id = null)
    {
        $rules = [
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'nama_ras' => 'required|string|max:100|unique:ras_hewan,nama_ras,' . $id . ',idras_hewan,idjenis_hewan,' . $request->idjenis_hewan,
        ];

        $messages = [
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
            'idjenis_hewan.exists' => 'Jenis hewan tidak valid.',
            'nama_ras.required' => 'Nama ras wajib diisi.',
            'nama_ras.max' => 'Nama ras maksimal 100 karakter.',
            'nama_ras.unique' => 'Nama ras ini sudah terdaftar untuk jenis hewan yang dipilih.',
        ];

        return $request->validate($rules, $messages);
    }

    private function formatNamaRas($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}