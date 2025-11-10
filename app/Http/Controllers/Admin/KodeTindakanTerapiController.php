<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $tindakan = DB::table('kode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.*',
                'kategori.nama_kategori',
                'kategori_klinis.nama_kategori_klinis'
            )
            ->orderBy('idkode_tindakan_terapi')
            ->get();

        $kategori = Kategori::all();
        $kategori_klinis = KategoriKlinis::all();

        return view('admin.tindakan.index', compact('tindakan', 'kategori', 'kategori_klinis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:5|unique:kode_tindakan_terapi,kode',
            'deskripsi_tindakan_terapi' => 'required|string',
            'idkategori' => 'required|integer',
            'idkategori_klinis' => 'required|integer'
        ]);

        KodeTindakanTerapi::create($request->only('kode', 'deskripsi_tindakan_terapi', 'idkategori', 'idkategori_klinis'));
        return back()->with('success', 'Tindakan terapi ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => "required|string|max:5|unique:kode_tindakan_terapi,kode,$id,idkode_tindakan_terapi",
            'deskripsi_tindakan_terapi' => 'required|string',
            'idkategori' => 'required|integer',
            'idkategori_klinis' => 'required|integer'
        ]);

        KodeTindakanTerapi::where('idkode_tindakan_terapi', $id)
            ->update($request->only('kode', 'deskripsi_tindakan_terapi', 'idkategori', 'idkategori_klinis'));

        return back()->with('success', 'Tindakan terapi diperbarui.');
    }

    public function destroy($id)
    {
        KodeTindakanTerapi::destroy($id);
        return back()->with('success', 'Tindakan terapi dihapus.');
    }
}
