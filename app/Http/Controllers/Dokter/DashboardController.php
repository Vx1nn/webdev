<?php
namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\{KategoriKlinis, KodeTerapi};

class DashboardController extends Controller
{
    public function index()
    {
        return view('dokter.dashboard', [
            'kategori_klinis' => KategoriKlinis::all(),
            'kode_terapi' => KodeTerapi::all(),
        ]);
    }
}
