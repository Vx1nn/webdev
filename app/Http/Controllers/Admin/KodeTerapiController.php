<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTerapi;

class KodeTerapiController extends Controller
{
    public function index()
    {
        $data = KodeTerapi::all();
        return view('admin.kode_terapi.index', compact('data'));
    }
}
