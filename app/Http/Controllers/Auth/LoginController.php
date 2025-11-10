<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use \Illuminate\Foundation\Auth\AuthenticatesUsers;

protected function authenticated(Request $request, $user)
{
    $role = strtolower($user->primary_role ?? '');

    switch ($role) {
        case 'administrator':
            return redirect()->route('admin.dashboard');
        case 'dokter':
            return redirect()->route('dokter.dashboard');
        case 'perawat':
            return redirect()->route('perawat.dashboard');
        case 'resepsionis':
            return redirect()->route('resepsionis.dashboard');
        case 'pemilik':
            return redirect()->route('pemilik.dashboard');
        default:
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Role pengguna tidak dikenali.'
            ]);
    }
}

}
