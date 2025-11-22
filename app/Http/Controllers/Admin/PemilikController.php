<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pemilik;
use App\Models\RoleUser;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PemilikController extends Controller
{
	public function index()
	{
		$search = request('search');
		$data = Pemilik::with('user')
			->when($search, function ($query) use ($search) {
				$query->whereHas('user', function ($q) use ($search) {
					$q->where('nama', 'like', '%' . $search . '%')
						->orWhere('email', 'like', '%' . $search . '%');
				})
					->orWhere('no_wa', 'like', '%' . $search . '%')
					->orWhere('alamat', 'like', '%' . $search . '%');
			})
			->paginate(15);

		return view('admin.pemilik.index', compact('data'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'nama' => 'required|string|max:255',
			'email' => 'required|email|unique:user,email',
			'password' => 'required|string|min:6',
			'no_wa' => 'required|string|max:20',
			'alamat' => 'required|string',
		]);

		$user = User::create([
			'nama' => $request->nama,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		RoleUser::create([
			'iduser' => $user->iduser,
			'idrole' => 5,
		]);

		Pemilik::create([
			'idpemilik' => $user->iduser,
			'iduser' => $user->iduser,
			'no_wa' => $request->no_wa,
			'alamat' => $request->alamat,
		]);

		return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil ditambahkan');
	}

	public function edit(Request $request, $id)
	{
		$pemilik = Pemilik::findOrFail($id);

		$request->validate([
			'nama' => 'required|string|max:255',
			'no_wa' => 'required|string|max:20',
			'alamat' => 'required|string',
		]);

		$pemilik->user->update([
			'nama' => $request->nama,
		]);

		$pemilik->update([
			'no_wa' => $request->no_wa,
			'alamat' => $request->alamat,
		]);

		return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil diperbarui');
	}

	public function delete($id)
	{
		$pemilik = Pemilik::findOrFail($id);
		$pemilik->delete();

		return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil dihapus');
	}
}
