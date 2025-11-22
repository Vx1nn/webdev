<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pet;
use App\Models\RoleUser;
use App\Models\TemuDokter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
	public function index()
	{
		$data = TemuDokter::with(['pet.pemilik.user', 'roleUser.user'])->orderBy('waktu_daftar', 'desc')->get();
		$pets = Pet::with('pemilik.user')->get();
		$dokters = RoleUser::where('idrole', 2)->with('user')->get();

		return view('admin.temu-dokter.index', compact('data', 'pets', 'dokters'));
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
			'status' => '0',
		]);

		return redirect()->route('admin.temu-dokter.index')->with('success', 'Jadwal temu dokter berhasil ditambahkan');
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

		return redirect()->route('admin.temu-dokter.index')->with('success', 'Jadwal temu dokter berhasil diperbarui');
	}

	public function delete($id)
	{
		$temu = TemuDokter::findOrFail($id);
		$temu->delete();

		return redirect()->route('admin.temu-dokter.index')->with('success', 'Jadwal temu dokter berhasil dihapus');
	}
}
