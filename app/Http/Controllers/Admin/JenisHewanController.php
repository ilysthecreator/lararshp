<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JenisHewanController extends Controller
{
    public function index()
    {
        // Menggunakan Eloquent
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

        JenisHewan::create($validatedData);

        return redirect()->route('admin.jenis-hewan.index')
                         ->with('success', 'Data jenis hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);

        return response()->json($jenisHewan);
    }

    public function update(Request $request, $id)
    {
        // Validasi data dengan pengecualian untuk data yang sedang diedit
        $validatedData = $this->validateJenisHewan($request, $id);

        // Format nama jenis
        $validatedData['nama_jenis_hewan'] = $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']);

        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->update($validatedData);

        return redirect()->route('admin.jenis-hewan.index')
                         ->with('success', 'Data jenis hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $jenisHewan = JenisHewan::findOrFail($id);
            $jenisHewan->delete();

            return redirect()->route('admin.jenis-hewan.index')
                             ->with('success', 'Data jenis hewan berhasil dihapus.');
        } catch (QueryException $e) {
            // Cek jika error disebabkan oleh foreign key constraint
            if ($e->errorInfo[1] == 1451) {
                return redirect()->route('admin.jenis-hewan.index')
                                 ->with('error', 'Gagal menghapus! Data ini masih berelasi dengan data lain di sistem.');
            }
            Log::error('QueryException on JenisHewanController@destroy: ' . $e->getMessage());
            return redirect()->route('admin.jenis-hewan.index')
                             ->with('error', 'Gagal menghapus data karena masalah database.');
        } catch (\Exception $e) {
            Log::error('Exception on JenisHewanController@destroy: ' . $e->getMessage());
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
}