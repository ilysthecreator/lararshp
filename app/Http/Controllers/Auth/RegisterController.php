<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pemilik; // Tambahkan Model Pemilik
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; // Tambahkan DB

class RegisterController extends Controller
{
    use RegistersUsers;

    // Redirect setelah register sukses
    protected $redirectTo = '/pemilik/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            // Gunakan 'nama' bukan 'name' sesuai database
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'], // Tabel 'user'
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            // Validasi tambahan
            'alamat' => ['required', 'string'],
            'no_wa' => ['required', 'string', 'max:20'],
        ]);
    }

    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Simpan ke tabel User
            $user = User::create([
                'nama' => $data['nama'], // Sesuai kolom DB 'nama'
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // 2. Beri Role Pemilik (ID 5)
            DB::table('role_user')->insert([
                'iduser' => $user->iduser,
                'idrole' => 5, // 5 = Pemilik
                'status' => 1
            ]);

            // 3. Simpan Detail ke tabel Pemilik
            Pemilik::create([
                'iduser' => $user->iduser,
                'alamat' => $data['alamat'],
                'no_wa' => $data['no_wa'],
            ]);

            return $user;
        });
    }
}