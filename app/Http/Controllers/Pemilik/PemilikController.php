<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Pemilik;
use App\Http\Controllers\Controller;

class PemilikController extends Controller
{
	public function profil()
	{
		$user = auth()->user();
		$pemilik = Pemilik::with('user')
			->where('iduser', $user->iduser)
			->first();

		return view('pemilik.profil', compact('user', 'pemilik'));
	}
}
