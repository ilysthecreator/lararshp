<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['pemilik.user', 'jenisHewan', 'rasHewan'])->latest('idpet')->paginate(10);
        return view('resepsionis.pet.index', compact('pets'));
    }

    public function create()
    {
        $pemiliks = Pemilik::with('user')->get();
        // Load RasHewan dengan JenisHewan agar bisa difilter di frontend jika mau, atau tampilkan semua
        $ras = RasHewan::with('jenisHewan')->get(); 
        return view('resepsionis.pet.create', compact('pemiliks', 'ras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'jenis_kelamin' => 'required|in:J,B',
            'warna_tanda' => 'required',
        ]);

        Pet::create($request->all());

        return redirect()->route('resepsionis.pet.index')->with('success', 'Hewan berhasil didaftarkan');
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $pemiliks = Pemilik::with('user')->get();
        $ras = RasHewan::with('jenisHewan')->get();
        return view('resepsionis.pet.edit', compact('pet', 'pemiliks', 'ras'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'idpemilik' => 'required',
            'idras_hewan' => 'required',
            'jenis_kelamin' => 'required',
            'warna_tanda' => 'required',
        ]);

        $pet = Pet::findOrFail($id);
        $pet->update($request->all());

        return redirect()->route('resepsionis.pet.index')->with('success', 'Data hewan diperbarui');
    }

    public function destroy($id)
    {
        Pet::findOrFail($id)->delete();
        return redirect()->route('resepsionis.pet.index')->with('success', 'Data hewan dihapus');
    }
}