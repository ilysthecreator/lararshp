<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('nama_role', 'asc')->get();
        $users = User::with('roles')->orderBy('nama', 'asc')->get();
        return view('admin.user.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::orderBy('nama_role', 'asc')->get();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'roles' => 'required|array',
            'roles.*' => 'exists:role,idrole',
        ]);

        $user = User::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->roles()->attach($validatedData['roles']);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::orderBy('nama_role', 'asc')->get();
        return response()->json(['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('user')->ignore($user->iduser, 'iduser')],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'roles' => 'required|array',
            'roles.*' => 'exists:role,idrole',
        ]);

        $updateData = [
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
        ];

        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($updateData);

        $user->roles()->sync($validatedData['roles']);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Mencegah user menghapus akunnya sendiri
        if (auth()->id() === $user->iduser) {
            return redirect()->route('admin.users.index')
                             ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Cek relasi dengan tabel pemilik
        if ($user->pemilik()->exists()) {
            return redirect()->route('admin.users.index')
                             ->with('error', 'Gagal menghapus! User ini terdaftar sebagai Pemilik dan memiliki data terkait.');
        }

        // Detach semua role sebelum menghapus user
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil dihapus.');
    }
}