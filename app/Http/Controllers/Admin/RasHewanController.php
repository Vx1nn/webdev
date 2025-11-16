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
        $data = RasHewan::with('jenisHewan')->get();
        $jenis = JenisHewan::all();
        return view('admin.ras-hewan.index', compact('data','jenis'));
    }

    public function create() { return view('admin.ras-hewan.create'); }

    public function store(Request $r)
    {
        $this->validateRasHewan($r);
        $this->createRasHewan($r);
        return back();
    }

    private function validateRasHewan(Request $r)
    {
        $r->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan'
        ]);
    }

    protected function createRasHewan(Request $r)
    {
        RasHewan::create([
            'nama_ras' => $this->formatNamaRasHewan($r->nama_ras),
            'idjenis_hewan' => $r->idjenis_hewan
        ]);
    }

    protected function formatNamaRasHewan($nama)
    {
        return ucwords(strtolower($nama));
    }

    public function edit(RasHewan $ras, Request $r)
    {
        $this->validateRasHewan($r);
        $ras->update([
            'nama_ras' => $this->formatNamaRasHewan($r->nama_ras),
            'idjenis_hewan' => $r->idjenis_hewan
        ]);
        return back();
    }

    public function delete(RasHewan $ras)
    {
        $ras->delete();
        return back();
    }
}
