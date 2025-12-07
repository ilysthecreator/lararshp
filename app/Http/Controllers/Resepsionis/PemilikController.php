<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::with('user')->paginate(10);
        return view('resepsionis.pemilik.index', compact('pemiliks'));
    }

    public function create()
    {
        return view('resepsionis.pemilik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'alamat' => 'required',
        ]);

        // Buat User Login
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pemilik',
        ]);

        // Buat Data Profile Pemilik
        Pemilik::create([
            'user_id' => $user->id,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('resepsionis.pemilik.index')->with('success', 'Pemilik berhasil ditambahkan');
    }
    
    // Tambahkan method edit, update, destroy sesuai kebutuhan
}