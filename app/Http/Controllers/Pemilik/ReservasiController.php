<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Pemilik;
use App\Models\TemuDokter;
use App\Http\Controllers\Controller;

class ReservasiController extends Controller
{
	public function index()
	{
		$user = auth()->user();
		$pemilik = Pemilik::firstOrCreate(
			['iduser' => $user->iduser],
			[
				'idpemilik' => $user->iduser,
				'no_wa' => '-',
				'alamat' => '-'
			]
		);

		$data = TemuDokter::with(['pet.pemilik', 'roleUser.user', 'rekamMedis'])
			->whereHas('pet', function ($query) use ($pemilik) {
				$query->where('idpemilik', $pemilik->idpemilik);
			})
			->orderBy('waktu_daftar', 'desc')
			->get();

		return view('pemilik.reservasi.index', compact('data'));
	}
}
