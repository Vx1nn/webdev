<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
	public function index()
	{
		$search = request('search');
		$data = Dokter::with('user')
			->when($search, function ($query) use ($search) {
				$query->whereHas('user', function ($q) use ($search) {
					$q->where('nama', 'like', '%' . $search . '%')
						->orWhere('email', 'like', '%' . $search . '%');
				})
					->orWhere('bidang_dokter', 'like', '%' . $search . '%')
					->orWhere('no_hp', 'like', '%' . $search . '%');
			})
			->paginate(15);

		return view('admin.dokter.index', compact('data'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'nama' => 'required|string|max:255',
			'email' => 'required|email|unique:user,email',
			'password' => 'required|string|min:6',
			'alamat' => 'nullable|string|max:100',
			'no_hp' => 'nullable|string|max:45',
			'bidang_dokter' => 'nullable|string|max:100',
			'jenis_kelamin' => 'nullable|in:L,P',
		]);

		$user = User::create([
			'nama' => $request->nama,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		RoleUser::create([
			'iduser' => $user->iduser,
			'idrole' => 2, // Dokter role
		]);

		Dokter::create([
			'iduser' => $user->iduser,
			'alamat' => $request->alamat,
			'no_hp' => $request->no_hp,
			'bidang_dokter' => $request->bidang_dokter,
			'jenis_kelamin' => $request->jenis_kelamin,
		]);

		return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil ditambahkan');
	}

	public function edit(Request $request, $id)
	{
		$dokter = Dokter::findOrFail($id);

		$request->validate([
			'nama' => 'required|string|max:255',
			'alamat' => 'nullable|string|max:100',
			'no_hp' => 'nullable|string|max:45',
			'bidang_dokter' => 'nullable|string|max:100',
			'jenis_kelamin' => 'nullable|in:L,P',
		]);

		$dokter->user->update([
			'nama' => $request->nama,
		]);

		$dokter->update([
			'alamat' => $request->alamat,
			'no_hp' => $request->no_hp,
			'bidang_dokter' => $request->bidang_dokter,
			'jenis_kelamin' => $request->jenis_kelamin,
		]);

		return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui');
	}

	public function delete($id)
	{
		$dokter = Dokter::findOrFail($id);
		$dokter->delete();

		return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil dihapus');
	}
}
