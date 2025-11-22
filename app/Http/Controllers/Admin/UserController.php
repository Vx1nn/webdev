<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function index()
	{
		$search = request('search');
		$data = User::with([
			'roles' => function ($q) {
				$q->select('role.idrole', 'role.nama_role', 'role_user.iduser', 'role_user.status');
			},
		])
			->when($search, function ($query) use ($search) {
				$query->where('nama', 'like', '%' . $search . '%')
					->orWhere('email', 'like', '%' . $search . '%');
			})
			->paginate(15);
		$roles = Role::all();

		return view('admin.user.index', compact('data', 'roles'));
	}

	public function create()
	{
		$roles = Role::all();

		return view('admin.user.create', compact('roles'));
	}

	public function store(Request $r)
	{
		$this->validateUser($r);
		$user = $this->createUser($r);
		
		if ($r->has('roles')) {
			$syncData = [];
			foreach ($r->roles as $roleId => $roleData) {
				if (isset($roleData['assigned']) && $roleData['assigned']) {
					$syncData[$roleId] = [
						'status' => isset($roleData['status']) ? (int)$roleData['status'] : 1
					];
				}
			}
			if (!empty($syncData)) {
				$user->roles()->sync($syncData);
			}
		}

		return back();
	}

	private function validateUser($r, $id = null)
	{
		$r->validate([
			'nama' => 'required|string|max:100',
			'email' => 'required|email|unique:user,email,' . $id . ',iduser',
			'idrole' => 'nullable|exists:role,idrole',
		]);
	}

	protected function createUser(Request $r)
	{
		$user = User::create([
			'nama' => $this->formatNamaUser($r->nama),
			'email' => $r->email,
			'password' => Hash::make($r->password),
		]);
		
		if ($r->idrole && !$r->has('roles')) {
			$user->roleUser()->create(['idrole' => $r->idrole]);
		}
		
		return $user;
	}

	protected function formatNamaUser($nama)
	{
		return ucwords(strtolower($nama));
	}

	public function edit(User $user, Request $r)
	{
		$this->validateUser($r, $user->iduser);
		$user->update([
			'nama' => $this->formatNamaUser($r->nama),
			'email' => $r->email,
			'aktif' => $r->aktif,
		]);
		
		if ($r->has('roles')) {
			$syncData = [];
			foreach ($r->roles as $roleId => $roleData) {
				if (isset($roleData['assigned']) && $roleData['assigned']) {
					$syncData[$roleId] = [
						'status' => isset($roleData['status']) ? (int)$roleData['status'] : 1
					];
				}
			}
			$user->roles()->sync($syncData);
		}

		return back();
	}

	public function toggleRole($iduser, $idrole)
	{
		$user = User::findOrFail($iduser);
		$role = $user->roles()->where('role.idrole', $idrole)->first();
		if ($role) {
			$new = $role->pivot->status ? 0 : 1;
			$user->roles()->updateExistingPivot($idrole, ['status' => $new]);
		}

		return back();
	}

	public function delete(User $user)
	{
		$user->delete();

		return back();
	}
}