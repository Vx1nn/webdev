<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenis = JenisHewan::orderBy('idjenis_hewan')->get();
        return view('admin.jenis_hewan.index', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama_jenis_hewan' => 'required|string|max:100']);
        JenisHewan::create($request->only('nama_jenis_hewan'));
        return back()->with('success', 'Jenis hewan baru ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_jenis_hewan' => 'required|string|max:100']);
        JenisHewan::where('idjenis_hewan', $id)->update($request->only('nama_jenis_hewan'));
        return back()->with('success', 'Jenis hewan diperbarui.');
    }

    public function destroy($id)
    {
        JenisHewan::destroy($id);
        return back()->with('success', 'Jenis hewan dihapus.');
    }
}
