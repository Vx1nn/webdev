<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;
use App\Models\User;
use App\Models\KodeTindakanTerapi;

class DashboardController extends Controller
{
    public function index()
    {
        $count = [
            'user' => User::count(),
            'pet' => Pet::count(),
            'tindakan' => KodeTindakanTerapi::count(),
            'rekam_medis' => DB::table('rekam_medis')->count(),
        ];

        $kategoriStats = DB::table('kategori')
            ->leftJoin('kode_tindakan_terapi', 'kategori.idkategori', '=', 'kode_tindakan_terapi.idkategori')
            ->select('kategori.nama_kategori', DB::raw('COUNT(kode_tindakan_terapi.idkode_tindakan_terapi) as total'))
            ->groupBy('kategori.nama_kategori')
            ->get();

        return view('admin.dashboard', compact('count', 'kategoriStats'));
    }
}
