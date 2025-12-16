<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        // Eager load roles
        $users = User::with('roles')->orderBy('nama', 'asc')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('nama_role', 'asc')->get();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => ['required', 'confirmed', 'min:6'],
            'roles' => 'required|array',
            'roles.*' => 'exists:role,idrole',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->roles()->attach($request->roles);

            DB::commit();
            // Redirect ke route PLURAL
            return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(User $user)
    {
        $user->load('roles');
        $allRoles = Role::orderBy('nama_role', 'asc')->get();

        return response()->json([
            'user' => $user,
            'roles' => $allRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('user')->ignore($user->iduser, 'iduser')],
            'password' => ['nullable', 'confirmed', 'min:6'],
            'roles' => 'required|array',
            'roles.*' => 'exists:role,idrole',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'nama' => $request->nama,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);
            $user->roles()->sync($request->roles);

            DB::commit();
            // Redirect ke route PLURAL
            return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->iduser) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        // Cek relasi pemilik jika ada
        if (method_exists($user, 'pemilik') && $user->pemilik()->exists()) {
            return back()->with('error', 'User ini adalah Pemilik Hewan, hapus data pemilik terlebih dahulu.');
        }

        DB::beginTransaction();
        try {
            $user->roles()->detach();
            $user->delete();
            DB::commit();
            
            // Redirect ke route PLURAL
            return redirect()->route('admin.users.index')->with('success', 'User dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal hapus: ' . $e->getMessage());
        }
    }
}