<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsResepsionis
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && strtolower(Auth::user()->primary_role ?? '') === 'resepsionis') {
            return $next($request);
        }

        abort(403, 'Akses ditolak - Anda bukan Resepsionis.');
    }
}
