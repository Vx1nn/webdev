<?php

namespace App\Http\Controllers\Admin;

use App\Models\Perawat;
use App\Models\RoleUser;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PerawatController extends Controller
{
	public function index()
	{
		$search = request('search');
		$data = Perawat::with('user')
			->when($search, function ($query) use ($search) {
				$query->whereHas('user', function ($q) use ($search) {
					$q->where('nama', 'like', '%' . $search . '%')
						->orWhere('email', 'like', '%' . $search . '%');
				})
					->orWhere('pendidikan', 'like', '%' . $search . '%')
					->orWhere('no_hp', 'like', '%' . $search . '%');
			})
			->paginate(15);

		return view('admin.perawat.index', compact('data'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'nama' => 'required|string|max:255',
			'email' => 'required|email|unique:user,email',
			'password' => 'required|string|min:6',
			'alamat' => 'nullable|string|max:100',
			'no_hp' => 'nullable|string|max:45',
			'jenis_kelamin' => 'nullable|in:L,P',
			'pendidikan' => 'nullable|string|max:100',
		]);

		$user = User::create([
			'nama' => $request->nama,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		RoleUser::create([
			'iduser' => $user->iduser,
			'idrole' => 3,
		]);

		Perawat::create([
			'iduser' => $user->iduser,
			'alamat' => $request->alamat,
			'no_hp' => $request->no_hp,
			'jenis_kelamin' => $request->jenis_kelamin,
			'pendidikan' => $request->pendidikan,
		]);

		return redirect()->route('admin.perawat.index')->with('success', 'Data perawat berhasil ditambahkan');
	}

	public function edit(Request $request, $id)
	{
		$perawat = Perawat::findOrFail($id);

		$request->validate([
			'nama' => 'required|string|max:255',
			'alamat' => 'nullable|string|max:100',
			'no_hp' => 'nullable|string|max:45',
			'jenis_kelamin' => 'nullable|in:L,P',
			'pendidikan' => 'nullable|string|max:100',
		]);

		$perawat->user->update([
			'nama' => $request->nama,
		]);

		$perawat->update([
			'alamat' => $request->alamat,
			'no_hp' => $request->no_hp,
			'jenis_kelamin' => $request->jenis_kelamin,
			'pendidikan' => $request->pendidikan,
		]);

		return redirect()->route('admin.perawat.index')->with('success', 'Data perawat berhasil diperbarui');
	}

	public function delete($id)
	{
		$perawat = Perawat::findOrFail($id);
		$perawat->delete();

		return redirect()->route('admin.perawat.index')->with('success', 'Data perawat berhasil dihapus');
	}
}
