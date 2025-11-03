<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTerapi;

class KodeTerapiController extends Controller
{
    public function index()
    {
        $data = KodeTerapi::all();
        return view('admin.kode_terapi.index', compact('data'));
    }

    public function create()
    {
        return view('admin.kode_terapi.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateKodeTerapi($request);

        $formattedName = $this->formatNamaTerapi($validated['nama_terapi']);
        $this->createKodeTerapi(
            strtoupper(trim($validated['kode'])),
            $formattedName,
            $validated['harga']
        );

        return redirect()
            ->route('admin.kode-terapi.index')
            ->with('success', 'Data Kode Terapi berhasil ditambahkan!');
    }

    private function validateKodeTerapi(Request $request)
    {
        return $request->validate([
            'kode' => 'required|string|max:50|unique:kode_terapi,kode',
            'nama_terapi' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
        ], [
            'kode.required' => 'Kode tindakan wajib diisi!',
            'kode.unique' => 'Kode ini sudah terdaftar!',
            'nama_terapi.required' => 'Nama terapi wajib diisi!',
            'harga.required' => 'Harga wajib diisi!',
            'harga.numeric' => 'Harga harus berupa angka!',
        ]);
    }

    private function createKodeTerapi(string $kode, string $nama, int $harga)
    {
        KodeTerapi::create([
            'kode' => $kode,
            'nama_terapi' => $nama,
            'harga' => $harga
        ]);
    }

    private function formatNamaTerapi(string $nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
