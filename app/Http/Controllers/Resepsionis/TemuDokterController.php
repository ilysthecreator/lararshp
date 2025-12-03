<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\Dokter;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
    public function index()
    {
        $temuDokter = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])->latest()->paginate(10);
        return view('resepsionis.temu-dokter.index', compact('temuDokter'));
    }

    public function create()
    {
        $pets = Pet::with('pemilik.user')->get();
        $dokters = Dokter::with('user')->get();
        return view('resepsionis.temu-dokter.create', compact('pets', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'iddokter' => 'required|exists:dokter,iddokter',
            'tgl_temu' => 'required|date',
            'jam_temu' => 'required',
            'keluhan' => 'nullable|string',
        ]);

        TemuDokter::create($request->all());

        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Jadwal temu berhasil dibuat.');
    }

    public function edit($id)
    {
        $temu = TemuDokter::findOrFail($id);
        $pets = Pet::with('pemilik.user')->get();
        $dokters = Dokter::with('user')->get();
        return view('resepsionis.temu-dokter.edit', compact('temu', 'pets', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $temu = TemuDokter::findOrFail($id);
        $temu->update($request->all());
        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Jadwal temu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        TemuDokter::findOrFail($id)->delete();
        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Jadwal dihapus.');
    }
}