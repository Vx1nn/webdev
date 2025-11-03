<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $data = RasHewan::with('jenis')->get();
        return view('admin.ras_hewan.index', compact('data'));
    }

    public function create()
    {
        $jenis = JenisHewan::all();
        return view('admin.ras_hewan.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRasHewan($request);

        $formattedName = $this->formatNamaRas($validated['nama_ras']);
        $this->createRasHewan($formattedName, $validated['idjenis_hewan']);

        return redirect()
            ->route('admin.ras-hewan.index')
            ->with('success', 'Data Ras Hewan berhasil ditambahkan!');
    }

    private function validateRasHewan(Request $request)
    {
        return $request->validate([
            'nama_ras' => 'required|string|max:100|unique:ras_hewan,nama_ras',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan'
        ], [
            'nama_ras.required' => 'Nama ras wajib diisi!',
            'nama_ras.unique' => 'Ras hewan sudah ada!',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih!',
        ]);
    }

    private function createRasHewan(string $nama, int $idjenis)
    {
        RasHewan::create([
            'nama_ras' => $nama,
            'idjenis_hewan' => $idjenis
        ]);
    }

    private function formatNamaRas(string $nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
