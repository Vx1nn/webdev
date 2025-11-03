<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::all();
        return view('admin.role.index', compact('data'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRole($request);

        $formatted = $this->formatNamaRole($validated['nama_role']);
        $this->createRole($formatted);

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'Data role baru berhasil ditambahkan!');
    }

    private function validateRole(Request $request)
    {
        return $request->validate([
            'nama_role' => 'required|string|max:50|unique:role,nama_role',
        ], [
            'nama_role.required' => 'Nama role wajib diisi!',
            'nama_role.unique' => 'Role sudah terdaftar!',
        ]);
    }
    private function createRole(string $nama)
    {
        Role::create(['nama_role' => $nama]);
    }
    
    private function formatNamaRole(string $nama)
    {
        return strtolower(trim($nama));
    }
}
