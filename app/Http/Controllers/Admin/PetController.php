<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])
                   ->orderBy('idpet', 'desc')
                   ->get();
        return view('admin.pet.index', compact('pets'));
    }

    public function create()
    {
        $pemilik = Pemilik::with('user')->get()->sortBy('user.nama');
        $rasHewan = RasHewan::with('jenisHewan')->get()->sortBy('nama_ras');
        return view('admin.pet.create', compact('pemilik', 'rasHewan'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePet($request);
        $validatedData['nama_pet'] = ucwords(strtolower(trim($validatedData['nama_pet'])));

        Pet::create($validatedData);

        return redirect()->route('admin.pet.index')
                         ->with('success', 'Data pet berhasil ditambahkan.');
    }

    public function edit(Pet $pet)
    {
        return response()->json($pet);
    }

    public function update(Request $request, Pet $pet)
    {
        $validatedData = $this->validatePet($request, $pet->idpet);
        $validatedData['nama_pet'] = ucwords(strtolower(trim($validatedData['nama_pet'])));

        $pet->update($validatedData);

        return redirect()->route('admin.pet.index')
                         ->with('success', 'Data pet berhasil diperbarui.');
    }

    public function destroy(Pet $pet)
    {
        try {
            if ($pet->rekamMedis()->exists()) {
                return redirect()->route('admin.pet.index')
                                 ->with('error', 'Gagal menghapus! Data ini memiliki riwayat rekam medis.');
            }

            $pet->delete();

            return redirect()->route('admin.pet.index')
                             ->with('success', 'Data pet berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.pet.index')
                             ->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    private function validatePet(Request $request, $id = null)
    {
        $rules = [
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'nama_pet' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tgl_lahir' => 'nullable|date',
            'warna_bulu' => 'nullable|string|max:100',
        ];

        $messages = [
            'idpemilik.required' => 'Pemilik wajib dipilih.',
            'idras_hewan.required' => 'Ras hewan wajib dipilih.',
            'nama_pet.required' => 'Nama pet wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        ];

        return $request->validate($rules, $messages);
    }
}