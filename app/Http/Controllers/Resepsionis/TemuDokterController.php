<?php

namespace App\Http\Controllers\Resepsionis;

use App\Models\Pet;
use App\Models\RoleUser;
use App\Models\TemuDokter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
	public function index()
	{
		$search = request('search');
		$data = TemuDokter::with(['pet.pemilik.user', 'roleUser.user'])
			->when($search, function ($query) use ($search) {
				$query->whereHas('pet', function ($q) use ($search) {
					$q->where('nama', 'like', '%' . $search . '%');
				})
					->orWhereHas('pet.pemilik.user', function ($q) use ($search) {
						$q->where('nama', 'like', '%' . $search . '%');
					})
					->orWhereHas('roleUser.user', function ($q) use ($search) {
						$q->where('nama', 'like', '%' . $search . '%');
					});
			})
			->orderBy('waktu_daftar', 'desc')
			->paginate(15);
		$pets = Pet::with('pemilik.user')->get();
		$dokters = RoleUser::where('idrole', 2)->with('user')->get(); // Role dokter = 2

		return view('resepsionis.temu-dokter.index', compact('data', 'pets', 'dokters'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'idpet' => 'required|exists:pet,idpet',
			'idrole_user' => 'required|exists:role_user,idrole_user',
			'waktu_daftar' => 'required|date',
			'no_urut' => 'nullable|integer',
		]);

		TemuDokter::create([
			'idpet' => $request->idpet,
			'idrole_user' => $request->idrole_user,
			'waktu_daftar' => $request->waktu_daftar,
			'no_urut' => $request->no_urut,
			'status' => '0', // Waiting...
		]);

		return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Jadwal temu dokter berhasil ditambahkan');
	}

	public function edit(Request $request, $id)
	{
		$temu = TemuDokter::findOrFail($id);

		$request->validate([
			'idpet' => 'required|exists:pet,idpet',
			'idrole_user' => 'required|exists:role_user,idrole_user',
			'waktu_daftar' => 'required|date',
			'no_urut' => 'nullable|integer',
			'status' => 'required|in:0,1',
		]);

		$temu->update($request->all());

		return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Jadwal temu dokter berhasil diperbarui');
	}
}
