<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
	public function index()
	{
		$data = DB::table('jenis_hewan')->whereNull('deleted_at')->get();

		return view('admin.jenis-hewan.index', compact('data'));
	}

	public function store(Request $r)
	{
		$r->validate(['nama_jenis_hewan' => 'required|string|max:100']);

		DB::table('jenis_hewan')->insert([
			'nama_jenis_hewan' => ucwords(strtolower($r->nama_jenis_hewan)),
		]);

		return back();
	}

	public function edit($id, Request $r)
	{
		$r->validate(['nama_jenis_hewan' => 'required|string|max:100']);

		DB::table('jenis_hewan')->where('idjenis_hewan', $id)->update([
			'nama_jenis_hewan' => ucwords(strtolower($r->nama_jenis_hewan)),
		]);

		return back();
	}

	public function delete($id)
	{
		JenisHewan::findOrFail($id)->delete();

		return back();
	}
}
