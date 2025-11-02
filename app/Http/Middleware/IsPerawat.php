<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsPerawat
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && strtolower(Auth::user()->primary_role === 'perawat')) {
            return $next($request);
        }

        abort(403, 'Akses ditolak - Anda bukan Perawat.');
    }
}
