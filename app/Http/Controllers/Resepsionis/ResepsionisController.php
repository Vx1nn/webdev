<?php
namespace App\Http\Controllers\resepsionis;
use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;

class ResepsionisController extends Controller
{
    public function pemilik()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('resepsionis.pemilik', compact('pemilik'));
    }

    public function pets()
    {
        $pets = Pet::with(['rasHewan','pemilik.user'])->get();
        return view('resepsionis.pets', compact('pets'));
    }

    public function temudokter()
    {
        $temudokter = TemuDokter::with(['pet','roleUser.user'])->orderByDesc('waktu_daftar')->get();
        return view('resepsionis.temu-dokter', compact('temudokter'));
    }
}
