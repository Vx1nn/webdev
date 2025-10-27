<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    JenisHewan, RasHewan, Kategori, KategoriKlinis,
    KodeTerapi, Pet, Role, User
};

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'jenis' => JenisHewan::all(),
            'ras' => RasHewan::with('jenis')->get(),
            'kategori' => Kategori::all(),
            'klinis' => KategoriKlinis::all(),
            'terapi' => KodeTerapi::all(),
            'pet' => Pet::with(['ras', 'kategori', 'user'])->get(),
            'role' => Role::all(),
            'user' => User::with('roles')->get(),
        ]);
    }
}
