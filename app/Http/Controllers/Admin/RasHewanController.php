<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index()
    {
        $ras = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
            ->orderBy('ras_hewan.idras_hewan')
            ->get();

        $jenis = JenisHewan::all();

        return view('admin.ras_hewan.index', compact('ras', 'jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|integer'
        ]);

        RasHewan::create($request->only('nama_ras', 'idjenis_hewan'));
        return back()->with('success', 'Ras hewan ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|integer'
        ]);

        RasHewan::where('idras_hewan', $id)->update($request->only('nama_ras', 'idjenis_hewan'));
        return back()->with('success', 'Ras hewan diperbarui.');
    }

    public function destroy($id)
    {
        RasHewan::destroy($id);
        return back()->with('success', 'Ras hewan dihapus.');
    }
}
