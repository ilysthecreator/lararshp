<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->orderBy('idpemilik', 'desc')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('admin.pemilik.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email', // Pastikan nama tabel 'user' sudah benar
            'password' => ['required', 'confirmed'],
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Gunakan firstOrCreate untuk memastikan role 'pemilik' ada.
            // Jika tidak ada, role tersebut akan dibuat secara otomatis.
            $pemilikRole = Role::firstOrCreate(['nama_role' => 'pemilik']);
            $user->roles()->attach($pemilikRole->idrole);

            $user->pemilik()->create([
                'no_wa' => $validatedData['no_wa'],
                'alamat' => $validatedData['alamat'],
            ]);

            DB::commit();
            return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating owner: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan data pemilik. Silakan coba lagi.')->withInput();
        }
    }

    public function edit(Pemilik $pemilik)
    {
        $pemilik->load('user');
        return response()->json($pemilik);
    }

    public function update(Request $request, Pemilik $pemilik)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('user', 'email')->ignore($pemilik->iduser, 'iduser')],
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $pemilik->user->update([
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
            ]);

            $pemilik->update([
                'no_wa' => $validatedData['no_wa'],
                'alamat' => $validatedData['alamat'],
            ]);

            DB::commit();
            return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating owner: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui data pemilik. Silakan coba lagi.');
        }
    }

    public function destroy(Pemilik $pemilik)
    {
        // Cek relasi dengan tabel Pet
        if ($pemilik->pets()->exists()) {
            return redirect()->route('admin.pemilik.index')
                             ->with('error', 'Gagal menghapus! Pemilik ini memiliki data hewan peliharaan (pet).');
        }

        DB::beginTransaction();
        try {
            $user = $pemilik->user;

            // Hapus data pemilik
            $pemilik->delete();

            // Hapus data user jika ada
            if ($user) {
                $user->roles()->detach();
                $user->delete();
            }

            DB::commit();
            return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik dan akun user terkait berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting owner: ' . $e->getMessage());
            return redirect()->route('admin.pemilik.index')->with('error', 'Gagal menghapus data pemilik.');
        }
    }
}