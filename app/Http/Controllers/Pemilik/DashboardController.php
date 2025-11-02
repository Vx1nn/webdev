<?php
namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $pets = Pet::with(['kategori', 'ras'])
            ->where('iduser', $user->iduser)
            ->get();

        return view('pemilik.dashboard', compact('user', 'pets'));
    }
}
