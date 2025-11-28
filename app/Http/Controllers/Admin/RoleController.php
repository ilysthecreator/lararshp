<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->orderBy('nama_role', 'asc')->get();

        if (request()->ajax()) {
            return response()->json(['roles' => $roles]);
        }

        return view('admin.role.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRole($request);
        $validatedData['nama_role'] = strtolower(trim($validatedData['nama_role']));

        Role::create($validatedData);

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(Role $role)
    {
        return response()->json($role);
    }

    public function update(Request $request, Role $role)
    {
        $validatedData = $this->validateRole($request, $role->idrole);
        $validatedData['nama_role'] = strtolower(trim($validatedData['nama_role']));

        $role->update($validatedData);

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return redirect()->route('admin.role.index')
                             ->with('error', 'Gagal menghapus! Role ini masih digunakan oleh user.');
        }

        $role->delete();

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil dihapus.');
    }

    private function validateRole(Request $request, $id = null)
    {
        $rules = [
            'nama_role' => 'required|string|max:50|unique:role,nama_role,' . $id . ',idrole',
        ];

        $messages = ['nama_role.unique' => 'Nama role sudah ada.'];

        return $request->validate($rules, $messages);
    }
}