<?php

namespace App\Http\Controllers\Admin;

use App\Models\RekamMedis;
use App\Http\Controllers\Controller;

class RekamMedisController extends Controller
{
	public function index()
	{
		$search = request('search');
		$data = RekamMedis::with(['pet.pemilik.user', 'dokter.user', 'detailRekamMedis'])
			->when($search, function ($query) use ($search) {
				$query->whereHas('pet', function ($q) use ($search) {
					$q->where('nama', 'like', '%' . $search . '%');
				})
					->orWhereHas('pet.pemilik.user', function ($q) use ($search) {
						$q->where('nama', 'like', '%' . $search . '%');
					})
					->orWhere('diagnosa', 'like', '%' . $search . '%')
					->orWhere('anamnesa', 'like', '%' . $search . '%');
			})
			->orderBy('created_at', 'desc')
			->paginate(15);

		return view('admin.rekam-medis.index', compact('data'));
	}

	public function show($id)
	{
		$rekamMedis = RekamMedis::with(['pet.pemilik.user', 'pet.rasHewan.jenisHewan', 'dokter.user', 'detailRekamMedis.kodeTindakanTerapi.kategori', 'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis'])->findOrFail($id);

		return view('admin.rekam-medis.show', compact('rekamMedis'));
	}

	public function delete($id)
	{
		$rekamMedis = RekamMedis::findOrFail($id);
		$rekamMedis->delete();

		return redirect()->route('admin.rekam-medis.index')->with('success', 'Rekam medis berhasil dihapus');
	}
}
