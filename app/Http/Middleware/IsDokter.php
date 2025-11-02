<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsDokter
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && strtolower(Auth::user()->primary_role === 'dokter')) {
            return $next($request);
        }

        abort(403, 'Akses ditolak - Anda bukan Dokter.');
    }
}
