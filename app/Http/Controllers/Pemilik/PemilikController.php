<?php
namespace App\Http\Controllers\pemilik;
use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    public function pets()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        $pets = $pemilik ? $pemilik->pets()->with('rasHewan')->get() : collect();
        return view('pemilik.pets', compact('pets'));
    }

    public function rekam()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        if(!$pemilik) return view('pemilik.rekam-medis', ['rekam'=>collect()]);

        $rekam = RekamMedis::with(['pet','dokter.user'])
            ->whereHas('pet', function($q) use ($pemilik){
                $q->where('idpemilik', $pemilik->idpemilik);
            })->orderByDesc('created_at')->get();

        return view('pemilik.rekam-medis', compact('rekam'));
    }

        public function show($id)
    {
        $r = RekamMedis::with([
            'pet.pemilik.user',
            'dokter.user',
            'detailRekamMedis.kodeTindakanTerapi.kategori',
            'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis'
        ])->findOrFail($id);

        // transform to clean json
        return response()->json([
            'id' => $r->idrekam_medis,
            'tanggal' => $r->created_at,
            'pet' => [
                'id' => $r->pet->idpet,
                'nama' => $r->pet->nama,
            ],
            'pemilik' => [
                'id' => $r->pet->pemilik->idpemilik ?? null,
                'nama' => $r->pet->pemilik->user->nama ?? '-',
                'no_wa' => $r->pet->pemilik->no_wa ?? '-',
            ],
            'dokter' => [
                'id' => $r->dokter->idrole_user ?? null,
                'nama' => $r->dokter->user->nama ?? '-'
            ],
            'anamnesa' => $r->anamnesa,
            'temuan' => $r->temuan_klinis,
            'diagnosa' => $r->diagnosa,
            'detail' => $r->detailRekamMedis->map(function($d){
                return [
                    'id' => $d->iddetail_rekam_medis,
                    'kode' => $d->kodeTindakanTerapi->kode ?? null,
                    'deskripsi' => $d->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? $d->detail,
                    'kategori' => $d->kodeTindakanTerapi->kategori->nama_kategori ?? '-',
                    'klinis' => $d->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis ?? '-',
                    'note' => $d->detail
                ];
            })
        ]);
    }
    
    public function reservasi()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        $reservations = $pemilik ? TemuDokter::with(['pet','roleUser.user'])->whereHas('pet', function($q) use ($pemilik){
            $q->where('idpemilik', $pemilik->idpemilik);
        })->orderByDesc('waktu_daftar')->get() : collect();

        return view('pemilik.reservasi', compact('reservations'));
    }
}
