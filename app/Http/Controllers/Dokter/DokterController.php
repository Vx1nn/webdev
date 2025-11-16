<?php
namespace App\Http\Controllers\dokter;
use App\Http\Controllers\Controller;
use App\Models\RekamMedis;

class DokterController extends Controller
{
    public function index()
    {
        $rekam = RekamMedis::with(['pet.rasHewan.jenisHewan', 'pet.pemilik.user', 'dokter.user'])
            ->orderByDesc('created_at')
            ->get();

        return view('dokter.rekam-medis', ['rekam' => $rekam]);
    }

    public function show($id)
    {
        $r = RekamMedis::with([
            'pet.pemilik.user',
            'dokter.user',
            'detailRekamMedis.kodeTindakanTerapi.kategori',
            'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis'
        ])->findOrFail($id);

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
            'detail' => $r->detailRekamMedis->map(function ($d) {
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
}
