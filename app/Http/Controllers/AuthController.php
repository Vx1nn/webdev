<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $roleName = strtolower($user->primary_role ?? '');

            if ($roleName === 'administrator' || $roleName === 'administrator' || $roleName === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Role pengguna tidak dikenali.']);
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
