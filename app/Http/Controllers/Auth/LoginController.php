<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Override: redirect path after successful login
     */
    protected function authenticated(Request $request, $user)
    {
        // Ambil role dari tabel role_user + role
        $role = DB::table('role_user')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role_user.iduser', $user->iduser)
            ->select('role.nama_role')
            ->first();

        if (!$role) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['Akun tidak memiliki role.']);
        }

        // Simpan sesi manual (opsional)
        Session::put('user', $user);
        Session::put('role', $role->nama_role);

        // Redirect berdasarkan role
        switch (strtolower($role->nama_role)) {
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
                return redirect()->route('home');
        }
    }

    /**
     * Path default (fallback) jika tidak ada role.
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Custom logout: clear session and redirect to login
     */
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
