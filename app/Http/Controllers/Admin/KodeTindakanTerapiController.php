<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use App\Models\KategoriKlinis;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $data = KodeTindakanTerapi::with('kategoriKlinis')->get();
        $kategori = KategoriKlinis::all();
        return view('admin.kode-tindakan.index', compact('data', 'kategori'));
    }

    public function create()
    {
        return view('admin.kode-tindakan.create');
    }

    public function store(Request $r)
    {
        $this->validateKodeTindakan($r);
        $this->createKodeTindakan($r);
        return back();
    }

    private function validateKodeTindakan(Request $r, $ignoreId = null)
    {
        $unique = 'unique:kode_tindakan_terapi,kode';
        if ($ignoreId)
            $unique .= ',' . $ignoreId . ',idkode_tindakan_terapi';
        $r->validate([
            'kode' => 'required|string|max:20|' . $unique,
            'deskripsi_tindakan_terapi' => 'required|string|max:255',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis'
        ]);
    }

    protected function createKodeTindakan(Request $r)
    {
        KodeTindakanTerapi::create([
            'kode' => strtoupper($r->kode),
            'deskripsi_tindakan_terapi' => $this->formatNamaTindakan($r->deskripsi_tindakan_terapi),
            'idkategori_klinis' => $r->idkategori_klinis
        ]);
    }

    protected function formatNamaTindakan($nama)
    {
        return ucwords(strtolower($nama));
    }

    public function edit(KodeTindakanTerapi $kode, Request $r)
    {
        $this->validateKodeTindakan($r, $kode->idkode_tindakan_terapi);
        $kode->update([
            'kode' => strtoupper($r->kode),
            'deskripsi_tindakan_terapi' => $this->formatNamaTindakan($r->deskripsi_tindakan_terapi),
            'idkategori_klinis' => $r->idkategori_klinis
        ]);
        return back();
    }

    public function delete(KodeTindakanTerapi $kode)
    {
        $kode->delete();
        return back();
    }

}
