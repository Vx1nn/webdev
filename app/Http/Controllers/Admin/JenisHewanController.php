<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index()
    {
        $data = JenisHewan::all();
        return view('admin.jenis_hewan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenis_hewan.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateJenisHewan($request);

        $formattedName = $this->formatNamaJenisHewan($validated['nama_jenis']);
        $this->createJenisHewan($formattedName);

        return redirect()
            ->route('admin.jenis-hewan.index')
            ->with('success', 'Data Jenis Hewan berhasil ditambahkan!');
    }

    private function validateJenisHewan(Request $request)
    {
        return $request->validate([
            'nama_jenis' => 'required|string|max:100|unique:jenis_hewan,nama_jenis',
        ], [
            'nama_jenis.required' => 'Nama jenis hewan wajib diisi!',
            'nama_jenis.unique' => 'Nama jenis hewan sudah ada di database!',
        ]);
    }
    private function createJenisHewan(string $namaJenis)
    {
        JenisHewan::create(['nama_jenis' => $namaJenis]);
    }

    private function formatNamaJenisHewan(string $nama)
    {
        return ucfirst(strtolower(trim($nama)));
    }
}
