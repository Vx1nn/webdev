<?php

namespace App\Http\Controllers\Perawat;

use App\Models\Perawat;
use App\Models\Pet;
use App\Models\RoleUser;
use App\Http\Controllers\Controller;

class PerawatController extends Controller
{
	public function viewPasien()
	{
		$data = Pet::with(['pemilik.user', 'rasHewan.jenisHewan', 'rekamMedis'])
			->get();

		return view('perawat.pasien.index', compact('data'));
	}

	public function profil()
	{
		$user = auth()->user();
		$roleUser = RoleUser::with(['user', 'role'])
			->where('iduser', $user->iduser)
			->where('idrole', 3)
			->first();

		$perawat = Perawat::where('iduser', $user->iduser)->first();

		return view('perawat.profil', compact('user', 'roleUser', 'perawat'));
	}
}
