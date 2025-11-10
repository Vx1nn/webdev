<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategori_klinis = KategoriKlinis::orderBy('idkategori_klinis')->get();
        return view('admin.kategori_klinis.index', compact('kategori_klinis'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori_klinis' => 'required|string|max:100']);
        KategoriKlinis::create($request->only('nama_kategori_klinis'));
        return back()->with('success', 'Kategori klinis ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_kategori_klinis' => 'required|string|max:100']);
        KategoriKlinis::where('idkategori_klinis', $id)->update($request->only('nama_kategori_klinis'));
        return back()->with('success', 'Kategori klinis diperbarui.');
    }

    public function destroy($id)
    {
        KategoriKlinis::destroy($id);
        return back()->with('success', 'Kategori klinis dihapus.');
    }
}
