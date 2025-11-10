<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;

class PetController extends Controller
{
    public function index()
    {
        $pets = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->select('pet.*', 'pemilik.no_wa', 'ras_hewan.nama_ras')
            ->orderBy('idpet')
            ->get();

        $pemilik = Pemilik::all();
        $ras = RasHewan::all();

        return view('admin.pet.index', compact('pets', 'pemilik', 'ras'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:45',
            'jenis_kelamin' => 'nullable|string|max:1',
            'idpemilik' => 'required|integer',
            'idras_hewan' => 'required|integer'
        ]);

        Pet::create($request->only(['nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idpemilik', 'idras_hewan']));
        return back()->with('success', 'Pet ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:45',
            'jenis_kelamin' => 'nullable|string|max:1',
            'idpemilik' => 'required|integer',
            'idras_hewan' => 'required|integer'
        ]);

        Pet::where('idpet', $id)->update($request->only(['nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idpemilik', 'idras_hewan']));
        return back()->with('success', 'Pet diperbarui.');
    }

    public function destroy($id)
    {
        Pet::destroy($id);
        return back()->with('success', 'Pet dihapus.');
    }
}
