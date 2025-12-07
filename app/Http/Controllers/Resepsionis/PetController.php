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
        $pets = Pet::with(['pemilik.user', 'jenisHewan', 'rasHewan'])->paginate(10);
        return view('resepsionis.pet.index', compact('pets'));
    }

    public function create()
    {
        $pemiliks = Pemilik::with('user')->get();
        $jenis = JenisHewan::all();
        $ras = RasHewan::all();
        return view('resepsionis.pet.create', compact('pemiliks', 'jenis', 'ras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hewan' => 'required',
            'pemilik_id' => 'required',
            'jenis_hewan_id' => 'required',
        ]);

        Pet::create($request->all());

        return redirect()->route('resepsionis.pet.index')->with('success', 'Hewan berhasil didaftarkan');
    }
}