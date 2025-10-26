<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $data = Pet::with(['kategori', 'ras', 'user'])->get();
        return view('admin.pet.index', compact('data'));
    }
}
