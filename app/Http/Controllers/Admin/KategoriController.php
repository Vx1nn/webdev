<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('idkategori')->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100']);
        Kategori::create($request->only('nama_kategori'));
        return back()->with('success', 'Kategori ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100']);
        Kategori::where('idkategori', $id)->update($request->only('nama_kategori'));
        return back()->with('success', 'Kategori diperbarui.');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);
        return back()->with('success', 'Kategori dihapus.');
    }
}
