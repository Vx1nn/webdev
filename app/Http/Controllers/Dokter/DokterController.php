<?php

namespace App\Http\Controllers\Dokter;

use App\Models\Dokter;
use App\Models\Pet;
use App\Models\RoleUser;
use App\Http\Controllers\Controller;

class DokterController extends Controller
{
	public function viewPasien()
	{
		$data = Pet::with(['pemilik.user', 'rasHewan.jenisHewan', 'rekamMedis'])
			->get();

		return view('dokter.pasien.index', compact('data'));
	}

	public function profil()
	{
		$user = auth()->user();
		$roleUser = RoleUser::with(['user', 'role'])
			->where('iduser', $user->iduser)
			->where('idrole', 2)
			->first();

		$dokter = Dokter::where('iduser', $user->iduser)->first();

		return view('dokter.profil', compact('user', 'roleUser', 'dokter'));
	}
}
