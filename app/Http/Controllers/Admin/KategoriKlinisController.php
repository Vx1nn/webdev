<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriKlinisController extends Controller
{
	public function index()
	{
		$data = DB::table('kategori_klinis')->whereNull('deleted_at')->get();

		return view('admin.kategori-klinis.index', compact('data'));
	}

	public function store(Request $r)
	{
		$r->validate([
			'nama_kategori_klinis' => 'required|string|max:100',
		]);

		DB::table('kategori_klinis')->insert([
			'nama_kategori_klinis' => ucwords(strtolower($r->nama_kategori_klinis)),
		]);

		return back();
	}

	public function edit($id, Request $r)
	{
		$r->validate([
			'nama_kategori_klinis' => 'required|string|max:100',
		]);

		DB::table('kategori_klinis')
			->where('idkategori_klinis', $id)
			->update([
				'nama_kategori_klinis' => ucwords(strtolower($r->nama_kategori_klinis)),
			]);

		return back();
	}

	public function delete($id)
	{
		KategoriKlinis::findOrFail($id)->delete();

		return back();
	}
}
