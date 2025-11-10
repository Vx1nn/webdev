<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemilik;
use App\Models\User;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.*', 'user.nama', 'user.email')
            ->orderBy('pemilik.idpemilik')
            ->get();

        $users = User::all();
        return view('admin.pemilik.index', compact('pemilik', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|integer|exists:user,iduser',
            'no_wa' => 'nullable|string|max:45',
            'alamat' => 'nullable|string|max:100'
        ]);

        Pemilik::create($request->only('iduser', 'no_wa', 'alamat'));
        return back()->with('success', 'Pemilik ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_wa' => 'nullable|string|max:45',
            'alamat' => 'nullable|string|max:100'
        ]);

        Pemilik::where('idpemilik', $id)->update($request->only('no_wa', 'alamat'));
        return back()->with('success', 'Data pemilik diperbarui.');
    }

    public function destroy($id)
    {
        Pemilik::destroy($id);
        return back()->with('success', 'Pemilik dihapus.');
    }
}
