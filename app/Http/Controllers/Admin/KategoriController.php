<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::all();
        return view('admin.kategori.index', compact('data'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateKategori($request);

        $formatted = $this->formatNamaKategori($validated['nama_kategori']);
        $this->createKategori($formatted);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Data kategori berhasil ditambahkan!');
    }

    private function validateKategori(Request $request)
    {
        return $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nama_kategori.unique' => 'Kategori sudah terdaftar!',
        ]);
    }
    private function createKategori(string $nama)
    {
        Kategori::create(['nama_kategori' => $nama]);
    }

    private function formatNamaKategori(string $nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
