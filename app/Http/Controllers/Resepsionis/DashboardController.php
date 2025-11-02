<?php
namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;

class DashboardController extends Controller
{
    public function index()
    {
        return view('resepsionis.dashboard', [
            'pet' => Pet::with(['kategori', 'ras', 'user'])->get()
        ]);
    }
}
