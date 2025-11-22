<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Perawat;
use App\Models\Pemilik;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function index()
	{
		$user = auth()->user();
		$activeRoles = $user->getActiveRoles();
		
		$profileData = [
			'user' => $user,
			'activeRoles' => $activeRoles,
			'profiles' => []
		];

		if (in_array('administrator', $activeRoles)) {
			$profileData['profiles']['administrator'] = [
				'roleUser' => RoleUser::with('role')
					->where('iduser', $user->iduser)
					->where('idrole', 1)
					->first()
			];
		}

		if (in_array('dokter', $activeRoles)) {
			$profileData['profiles']['dokter'] = [
				'roleUser' => RoleUser::with('role')
					->where('iduser', $user->iduser)
					->where('idrole', 2)
					->first(),
				'data' => Dokter::where('iduser', $user->iduser)->first()
			];
		}

		if (in_array('perawat', $activeRoles)) {
			$profileData['profiles']['perawat'] = [
				'roleUser' => RoleUser::with('role')
					->where('iduser', $user->iduser)
					->where('idrole', 3)
					->first(),
				'data' => Perawat::where('iduser', $user->iduser)->first()
			];
		}

		if (in_array('resepsionis', $activeRoles)) {
			$profileData['profiles']['resepsionis'] = [
				'roleUser' => RoleUser::with('role')
					->where('iduser', $user->iduser)
					->where('idrole', 4)
					->first()
			];
		}

		if (in_array('pemilik', $activeRoles)) {
			$pemilik = Pemilik::firstOrCreate(
				['iduser' => $user->iduser],
				[
					'idpemilik' => $user->iduser,
					'no_wa' => '-',
					'alamat' => '-'
				]
			);
			
			$profileData['profiles']['pemilik'] = [
				'roleUser' => RoleUser::with('role')
					->where('iduser', $user->iduser)
					->where('idrole', 5)
					->first(),
				'data' => $pemilik
			];
		}

		return view('site.profile', $profileData);
	}
}
