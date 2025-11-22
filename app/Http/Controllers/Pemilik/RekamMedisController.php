<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Pemilik;
use App\Models\RekamMedis;
use App\Http\Controllers\Controller;

class RekamMedisController extends Controller
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

	$data = RekamMedis::with(['pet.pemilik', 'pet.rasHewan.jenisHewan', 'dokter.user'])
		->whereHas('pet', function ($query) use ($pemilik) {
			$query->where('idpemilik', $pemilik->idpemilik);
		})
		->orderBy('created_at', 'desc')
		->get();

	return view('pemilik.rekam-medis.index', compact('data'));
}

public function show($id)
{
	$user = auth()->user();
	$pemilik = Pemilik::firstOrCreate(
		['iduser' => $user->iduser],
		[
			'idpemilik' => $user->iduser,
			'no_wa' => '-',
			'alamat' => '-'
		]
	);		$rekamMedis = RekamMedis::with([
			'pet.pemilik.user',
			'pet.rasHewan.jenisHewan',
			'dokter.user',
			'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis',
		])
			->whereHas('pet', function ($query) use ($pemilik) {
				$query->where('idpemilik', $pemilik->idpemilik);
			})
			->findOrFail($id);

		return view('pemilik.rekam-medis.show', compact('rekamMedis'));
	}
}
