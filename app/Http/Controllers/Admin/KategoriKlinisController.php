<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $data = KategoriKlinis::all();
        return view('admin.kategori_klinis.index', compact('data'));
    }

    public function create()
    {
        return view('admin.kategori_klinis.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateKategoriKlinis($request);

        $formatted = $this->formatNamaKategoriKlinis($validated['nama_kategori_klinis']);
        $this->createKategoriKlinis($formatted);

        return redirect()
            ->route('admin.kategori-klinis.index')
            ->with('success', 'Data kategori klinis berhasil ditambahkan!');
    }

    private function validateKategoriKlinis(Request $request)
    {
        return $request->validate([
            'nama_kategori_klinis' => 'required|string|max:100|unique:kategori_klinis,nama_kategori_klinis',
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi!',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah terdaftar!',
        ]);
    }

    private function createKategoriKlinis(string $nama)
    {
        KategoriKlinis::create(['nama_kategori_klinis' => $nama]);
    }

    private function formatNamaKategoriKlinis(string $nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
