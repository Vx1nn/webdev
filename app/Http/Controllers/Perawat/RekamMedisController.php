<?php

namespace App\Http\Controllers\Perawat;

use App\Models\Pet;
use App\Models\RekamMedis;
use App\Models\RoleUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
	public function index()
	{
		$data = RekamMedis::with(['pet.pemilik.user', 'pet.rasHewan.jenisHewan', 'dokter.user'])
			->orderBy('created_at', 'desc')
			->get();

		$pets = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])->get();
		$dokters = RoleUser::with('user')->where('idrole', 2)->where('status', 1)->get();

		return view('perawat.rekam-medis.index', compact('data', 'pets', 'dokters'));
	}

	public function store(Request $r)
	{
		$this->validateRekamMedis($r);

		RekamMedis::create([
			'created_at' => now(),
			'anamnesa' => $r->anamnesa,
			'temuan_klinis' => $r->temuan_klinis,
			'diagnosa' => $r->diagnosa,
			'idpet' => $r->idpet,
			'dokter_pemeriksa' => $r->dokter_pemeriksa,
		]);

		return back()->with('success', 'Rekam medis berhasil ditambahkan');
	}

	private function validateRekamMedis(Request $r)
	{
		$r->validate([
			'anamnesa' => 'required|string|max:1000',
			'temuan_klinis' => 'required|string|max:1000',
			'diagnosa' => 'required|string|max:1000',
			'idpet' => 'required|exists:pet,idpet',
			'dokter_pemeriksa' => 'required|exists:role_user,idrole_user',
		]);
	}

	public function edit($id, Request $r)
	{
		$this->validateRekamMedis($r);

		$rekamMedis = RekamMedis::findOrFail($id);

		$rekamMedis->update([
			'anamnesa' => $r->anamnesa,
			'temuan_klinis' => $r->temuan_klinis,
			'diagnosa' => $r->diagnosa,
			'idpet' => $r->idpet,
			'dokter_pemeriksa' => $r->dokter_pemeriksa,
		]);

		return back()->with('success', 'Rekam medis berhasil diupdate');
	}

	public function delete($id)
	{
		$rekamMedis = RekamMedis::findOrFail($id);
		$rekamMedis->delete();

		return back()->with('success', 'Rekam medis berhasil dihapus');
	}

	public function show($id)
	{
		$rekamMedis = RekamMedis::with([
			'pet.pemilik.user',
			'pet.rasHewan.jenisHewan',
			'dokter.user',
			'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis',
		])->findOrFail($id);

		return view('perawat.rekam-medis.show', compact('rekamMedis'));
	}
}
