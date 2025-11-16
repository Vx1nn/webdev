<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
  public function index()
  {
    $data = DB::table('role')->get();
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
    DB::table('role')->where('idrole', $id)->delete();
    return back();
  }
}