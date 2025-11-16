<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function index()
  {
    $data = User::with([
      'roles' => function ($q) {
        $q->select('role.idrole', 'role.nama_role', 'role_user.iduser', 'role_user.status');
      }
    ])->get();
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
    $this->createUser($r);
    return back();
  }

  private function validateUser($r, $id = null)
  {
    $r->validate([
      'nama' => 'required|string|max:100',
      'email' => 'required|email|unique:user,email,' . $id . ',iduser',
      'idrole' => 'nullable|exists:role,idrole'
    ]);
  }

  protected function createUser(Request $r)
  {
    $user = User::create([
      'nama' => $this->formatNamaUser($r->nama),
      'email' => $r->email,
      'password' => Hash::make($r->password)
    ]);
    $user->roleUser()->create(['idrole' => $r->idrole]);
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
      'aktif' => $r->aktif
    ]);
    if ($r->idrole) {
      $user->roles()->sync($r->idrole);
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