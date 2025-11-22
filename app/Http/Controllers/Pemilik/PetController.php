<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Pemilik;
use App\Models\Pet;
use App\Http\Controllers\Controller;

class PetController extends Controller
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

		$data = Pet::with(['rasHewan.jenisHewan', 'rekamMedis'])
			->where('idpemilik', $pemilik->idpemilik)
			->get();

		return view('pemilik.pet.index', compact('data'));
	}
}
