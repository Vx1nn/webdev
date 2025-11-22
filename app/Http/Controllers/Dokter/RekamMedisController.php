<?php

namespace App\Http\Controllers\Dokter;

use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;
use App\Models\RekamMedis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
	public function index()
	{
		$data = RekamMedis::with(['pet.pemilik', 'pet.rasHewan.jenisHewan', 'dokter.user'])
			->orderBy('created_at', 'desc')
			->get();

		return view('dokter.rekam-medis.index', compact('data'));
	}

	public function show($id)
	{
		$rekamMedis = RekamMedis::with([
			'pet.pemilik.user',
			'pet.rasHewan.jenisHewan',
			'dokter.user',
			'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis',
		])->findOrFail($id);

		$kodeTindakan = KodeTindakanTerapi::with('kategoriKlinis')->get();

		return view('dokter.rekam-medis.show', compact('rekamMedis', 'kodeTindakan'));
	}

	public function storeDetail($id, Request $r)
	{
		$this->validateDetail($r);

		DetailRekamMedis::create([
			'idrekam_medis' => $id,
			'idkode_tindakan_terapi' => $r->idkode_tindakan_terapi,
			'detail' => $r->detail,
		]);

		return back()->with('success', 'Detail rekam medis berhasil ditambahkan');
	}

	private function validateDetail(Request $r)
	{
		$r->validate([
			'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
			'detail' => 'nullable|string|max:1000',
		]);
	}

	public function editDetail($id, $detailId, Request $r)
	{
		$this->validateDetail($r);

		$detail = DetailRekamMedis::where('idrekam_medis', $id)
			->where('iddetail_rekam_medis', $detailId)
			->firstOrFail();

		$detail->update([
			'idkode_tindakan_terapi' => $r->idkode_tindakan_terapi,
			'detail' => $r->detail,
		]);

		return back()->with('success', 'Detail rekam medis berhasil diupdate');
	}

	public function deleteDetail($id, $detailId)
	{
		$detail = DetailRekamMedis::where('idrekam_medis', $id)
			->where('iddetail_rekam_medis', $detailId)
			->firstOrFail();

		$detail->delete();

		return back()->with('success', 'Detail rekam medis berhasil dihapus');
	}
}
