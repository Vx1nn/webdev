<?php

namespace App\Http\Controllers\Resepsionis;

use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RasHewan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetController extends Controller
{
	public function index()
	{
		$search = request('search');
		$data = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])
			->when($search, function ($query) use ($search) {
				$query->where('nama', 'like', '%' . $search . '%')
					->orWhereHas('pemilik.user', function ($q) use ($search) {
						$q->where('nama', 'like', '%' . $search . '%');
					})
					->orWhereHas('rasHewan', function ($q) use ($search) {
						$q->where('nama_ras', 'like', '%' . $search . '%');
					});
			})
			->paginate(15);
		$pemilikList = Pemilik::with('user')->get();
		$rasList = RasHewan::with('jenisHewan')->get();

		return view('resepsionis.pet.index', compact('data', 'pemilikList', 'rasList'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'idpemilik' => 'required|exists:pemilik,idpemilik',
			'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
			'nama' => 'required|string|max:255',
			'jenis_kelamin' => 'required|in:J,B',
			'tanggal_lahir' => 'nullable|date',
			'warna_tanda' => 'nullable|string|max:50',
		]);

		Pet::create($request->all());

		return redirect()->route('resepsionis.pet.index')->with('success', 'Data pet berhasil ditambahkan');
	}

	public function edit(Request $request, Pet $pet)
	{
		$request->validate([
			'idpemilik' => 'required|exists:pemilik,idpemilik',
			'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
			'nama' => 'required|string|max:255',
			'jenis_kelamin' => 'required|in:J,B',
			'tanggal_lahir' => 'nullable|date',
			'warna_tanda' => 'nullable|string|max:50',
		]);

		$pet->update($request->all());

		return redirect()->route('resepsionis.pet.index')->with('success', 'Data pet berhasil diperbarui');
	}

	public function delete(Pet $pet)
	{
		$pet->delete();

		return redirect()->route('resepsionis.pet.index')->with('success', 'Data pet berhasil dihapus');
	}
}
