<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\RasHewan;

class PetController extends Controller
{
    public function index()
    {
        $data = Pet::with(['rasHewan.jenisHewan', 'pemilik'])->get();
        $ras = RasHewan::with('jenisHewan')->get();
        $pemilik = \App\Models\Pemilik::with('user')->get();
        return view('admin.pet.index', compact('data', 'ras', 'pemilik'));
    }

    public function create()
    {
        return view('admin.pet.create');
    }

    public function store(Request $r)
    {
        $this->validatePet($r);
        $this->createPet($r);
        return back();
    }

    private function validatePet(Request $r)
    {
        $r->validate([
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:J,B',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'idpemilik' => 'required|exists:pemilik,idpemilik'
        ]);
    }

    protected function createPet(Request $r)
    {
        Pet::create([
            'nama' => $this->formatNamaPet($r->nama),
            'jenis_kelamin' => $r->jenis_kelamin,
            'idras_hewan' => $r->idras_hewan,
            'idpemilik' => $r->idpemilik
        ]);
    }

    protected function formatNamaPet($nama)
    {
        return ucwords(strtolower($nama));
    }

    public function edit(Pet $pet, Request $r)
    {
        $this->validatePet($r);
        $pet->update([
            'nama' => $this->formatNamaPet($r->nama),
            'tanggal_lahir' => $r->tanggal_lahir,
            'jenis_kelamin' => $r->jenis_kelamin,
            'idras_hewan' => $r->idras_hewan
        ]);
        return back();
    }

    public function delete(Pet $pet)
    {
        $pet->delete();
        return back();
    }
}
