<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTerapi;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $data = KodeTerapi::all();
        return view('admin.kode_tindakan_terapi.index', compact('data'));
    }

    public function create()
    {
        return view('admin.kode_tindakan_terapi.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateKodeTindakanTerapi($request);

        $kode = strtoupper(trim($validated['kode']));
        $nama = $this->formatNamaTerapi($validated['nama_terapi']);
        $harga = (int) $validated['harga'];

        $this->createKodeTindakanTerapi($kode, $nama, $harga);

        return redirect()
            ->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Data Kode Tindakan Terapi berhasil ditambahkan!');
    }

    // Validasi
    private function validateKodeTindakanTerapi(Request $request)
    {
        return $request->validate([
            'kode' => 'required|string|max:50|unique:kode_terapi,kode',
            'nama_terapi' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
        ], [
            'kode.required' => 'Kode tindakan wajib diisi!',
            'kode.unique' => 'Kode tindakan sudah terdaftar!',
            'nama_terapi.required' => 'Nama terapi wajib diisi!',
            'harga.required' => 'Harga wajib diisi!',
            'harga.numeric' => 'Harga harus berupa angka!',
        ]);
    }

    // Helper: simpan
    private function createKodeTindakanTerapi(string $kode, string $nama, int $harga)
    {
        KodeTerapi::create([
            'kode' => $kode,
            'nama_terapi' => $nama,
            'harga' => $harga
        ]);
    }

    // Helper: format nama
    private function formatNamaTerapi(string $nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
