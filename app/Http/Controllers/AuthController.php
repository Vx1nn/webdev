<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login user
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Pakai Auth::attempt jika password di-hash dengan bcrypt sesuai Laravel
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Ambil role aman (null-safe)
            $roleName = strtolower($user->primary_role ?? '');

            if ($roleName === 'administrator' || $roleName === 'administrator' || $roleName === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // jika role tidak ditemukan atau bukan admin
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Role pengguna tidak dikenali.']);
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
