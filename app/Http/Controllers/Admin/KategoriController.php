<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
	public function index()
	{
		$data = DB::table('kategori')->whereNull('deleted_at')->get();

		return view('admin.kategori.index', compact('data'));
	}

	public function store(Request $r)
	{
		$r->validate([
			'nama_kategori' => 'required|string|max:100',
		]);

		DB::table('kategori')->insert([
			'nama_kategori' => ucwords(strtolower($r->nama_kategori)),
		]);

		return back();
	}

	public function edit($id, Request $r)
	{
		$r->validate([
			'nama_kategori' => 'required|string|max:100',
		]);

		DB::table('kategori')
			->where('idkategori', $id)
			->update([
				'nama_kategori' => ucwords(strtolower($r->nama_kategori)),
			]);

		return back();
	}

	public function delete($id)
	{
		Kategori::findOrFail($id)->delete();

		return back();
	}
}
