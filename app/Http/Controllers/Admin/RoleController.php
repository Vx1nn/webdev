<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
	public function index()
	{
		$data = DB::table('role')->whereNull('deleted_at')->get();

		return view('admin.role.index', compact('data'));
	}

	public function store(Request $r)
	{
		$r->validate(['nama_role' => 'required|string|max:50']);

		DB::table('role')->insert([
			'nama_role' => ucwords(strtolower($r->nama_role)),
		]);

		return back();
	}

	public function edit($id, Request $r)
	{
		$r->validate(['nama_role' => 'required|string|max:50']);

		DB::table('role')
			->where('idrole', $id)
			->update([
				'nama_role' => ucwords(strtolower($r->nama_role)),
			]);

		return back();
	}

	public function delete($id)
	{
		Role::findOrFail($id)->delete();

		return back();
	}
}
