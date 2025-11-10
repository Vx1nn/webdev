<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('idrole')->get();
        return view('admin.role.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_role' => 'required|string|max:100']);
        Role::create($request->only('nama_role'));
        return back()->with('success', 'Role baru ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_role' => 'required|string|max:100']);
        Role::where('idrole', $id)->update($request->only('nama_role'));
        return back()->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return back()->with('success', 'Role berhasil dihapus.');
    }
}
