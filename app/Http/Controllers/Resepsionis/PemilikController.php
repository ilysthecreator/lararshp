<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::with('user')->latest('idpemilik')->paginate(10);
        return view('resepsionis.pemilik.index', compact('pemiliks'));
    }

    public function create()
    {
        return view('resepsionis.pemilik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email', // Sesuai tabel user
            'password' => 'required|min:6',
            'alamat' => 'required|string',
            'no_wa' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            // Assign Role Pemilik (ID 5)
            DB::table('role_user')->insert([
                'iduser' => $user->iduser,
                'idrole' => 5, // 5 = Pemilik
                'status' => 1
            ]);

            Pemilik::create([
                'iduser' => $user->iduser,
                'alamat' => $request->alamat,
                'no_wa' => $request->no_wa,
            ]);
        });

        return redirect()->route('resepsionis.pemilik.index')->with('success', 'Pemilik berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('resepsionis.pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('user', 'email')->ignore($pemilik->user->iduser, 'iduser')],
            'alamat' => 'required|string',
            'no_wa' => 'required|string',
            'password' => 'nullable|min:6',
        ]);

        DB::transaction(function () use ($request, $pemilik) {
            $dataUser = [
                'nama' => $request->nama,
                'email' => $request->email,
            ];
            if ($request->filled('password')) {
                $dataUser['password'] = Hash::make($request->password);
            }
            $pemilik->user->update($dataUser);

            $pemilik->update([
                'alamat' => $request->alamat,
                'no_wa' => $request->no_wa,
            ]);
        });

        return redirect()->route('resepsionis.pemilik.index')->with('success', 'Data pemilik diperbarui');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $user = $pemilik->user;
        $pemilik->delete();
        $user->delete(); // Hapus user juga
        return redirect()->route('resepsionis.pemilik.index')->with('success', 'Data pemilik dihapus');
    }
}