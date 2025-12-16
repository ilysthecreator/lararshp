<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil dokter.
     */
    public function show()
    {
        $user = Auth::user()->load('dokter');
        return view('dokter.profile', compact('user')); // Path sudah benar
    }

    /**
     * Memperbarui profil dokter.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('user')->ignore($user->iduser, 'iduser')],
            'spesialisasi' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:20',
            'password' => 'nullable|confirmed',
        ]);

        DB::beginTransaction();
        try {
            // Update data di tabel user
            $user->nama = $request->nama;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update data di tabel dokter
            if ($user->dokter) {
                $user->dokter->update([
                    'spesialisasi' => $request->spesialisasi,
                    'no_telepon' => $request->no_telepon,
                ]);
            }

            DB::commit();

            return redirect()->route('dokter.profile.show')->with('success', 'Profil berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage())->withInput();
        }
    }
}