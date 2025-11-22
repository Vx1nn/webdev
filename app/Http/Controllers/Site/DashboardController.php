<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
	public function index()
	{
		if (!Auth::check()) {
			return redirect()->route('login');
		}

		$user = Auth::user();
		$activeRoles = $user->getActiveRoles();

		// Build menu structure based on active roles
		$menus = [];

		if ($user->hasActiveRole('administrator')) {
			$menus['administrator'] = [
				'title' => 'Menu Administrator',
				'icon' => 'bi-shield-check',
				'sections' => [
					[
						'title' => 'Data Master',
						'icon' => 'bi-database-fill',
						'items' => [
							['title' => 'Pengguna', 'route' => 'admin.user.index', 'icon' => 'fas fa-user'],
							['title' => 'Role', 'route' => 'admin.role.index', 'icon' => 'fas fa-user-shield'],
							['title' => 'Hewan Peliharaan', 'route' => 'admin.pet.index', 'icon' => 'fas fa-paw'],
							['title' => 'Jenis Hewan', 'route' => 'admin.jenis-hewan.index', 'icon' => 'fas fa-dog'],
							['title' => 'Ras Hewan', 'route' => 'admin.ras-hewan.index', 'icon' => 'fas fa-cat'],
							['title' => 'Kategori', 'route' => 'admin.kategori.index', 'icon' => 'fas fa-tags'],
							['title' => 'Kategori Klinis', 'route' => 'admin.kategori-klinis.index', 'icon' => 'fas fa-stethoscope'],
							['title' => 'Kode Tindakan', 'route' => 'admin.kode-tindakan.index', 'icon' => 'fas fa-file-medical'],
						]
					],
					[
						'title' => 'Data Transaksional',
						'icon' => 'bi-file-earmark-text-fill',
						'items' => [
							['title' => 'Pemilik', 'route' => 'admin.pemilik.index', 'icon' => 'fas fa-user-friends'],
							['title' => 'Dokter', 'route' => 'admin.dokter.index', 'icon' => 'fas fa-user-md'],
							['title' => 'Perawat', 'route' => 'admin.perawat.index', 'icon' => 'fas fa-user-nurse'],
							['title' => 'Rekam Medis', 'route' => 'admin.rekam-medis.index', 'icon' => 'fas fa-notes-medical'],
							['title' => 'Temu Dokter', 'route' => 'admin.temu-dokter.index', 'icon' => 'fas fa-calendar-check'],
						]
					]
				]
			];
		}

		if ($user->hasActiveRole('dokter')) {
			$menus['dokter'] = [
				'title' => 'Menu Dokter',
				'icon' => 'fas fa-user-md',
				'sections' => [
					[
						'title' => 'Data Dokter',
						'icon' => 'fas fa-notes-medical',
						'items' => [
							['title' => 'Rekam Medis', 'route' => 'dokter.rekam-medis.index', 'icon' => 'fas fa-file-medical'],
							['title' => 'Pasien', 'route' => 'dokter.pasien.index', 'icon' => 'fas fa-procedures'],
						]
					]
				]
			];
		}

		if ($user->hasActiveRole('perawat')) {
			$menus['perawat'] = [
				'title' => 'Menu Perawat',
				'icon' => 'fas fa-user-nurse',
				'sections' => [
					[
						'title' => 'Data Perawat',
						'icon' => 'fas fa-file-medical-alt',
						'items' => [
							['title' => 'Rekam Medis', 'route' => 'perawat.rekam-medis.index', 'icon' => 'fas fa-file-medical'],
							['title' => 'Pasien', 'route' => 'perawat.pasien.index', 'icon' => 'fas fa-procedures'],
						]
					]
				]
			];
		}

		if ($user->hasActiveRole('resepsionis')) {
			$menus['resepsionis'] = [
				'title' => 'Menu Resepsionis',
				'icon' => 'fas fa-desktop',
				'sections' => [
					[
						'title' => 'Data Resepsionis',
						'icon' => 'fas fa-desktop',
						'items' => [
							['title' => 'Data Pemilik', 'route' => 'resepsionis.pemilik.index', 'icon' => 'fas fa-user'],
							['title' => 'Data Hewan', 'route' => 'resepsionis.pet.index', 'icon' => 'fas fa-paw'],
							['title' => 'Temu Dokter', 'route' => 'resepsionis.temu-dokter.index', 'icon' => 'fas fa-calendar-plus'],
						]
					]
				]
			];
		}

		if ($user->hasActiveRole('pemilik')) {
			$menus['pemilik'] = [
				'title' => 'Menu Pemilik',
				'icon' => 'fas fa-user',
				'sections' => [
					[
						'title' => 'Data Saya',
						'icon' => 'fas fa-folder-open',
						'items' => [
							['title' => 'Hewan Peliharaan', 'route' => 'pemilik.pet.index', 'icon' => 'fas fa-paw'],
							['title' => 'Rekam Medis', 'route' => 'pemilik.rekam-medis.index', 'icon' => 'fas fa-notes-medical'],
							['title' => 'Reservasi', 'route' => 'pemilik.temu-dokter.index', 'icon' => 'fas fa-calendar-check'],
						]
					]
				]
			];
		}

		return view('site.dashboard', compact('menus', 'activeRoles'));
	}
}
