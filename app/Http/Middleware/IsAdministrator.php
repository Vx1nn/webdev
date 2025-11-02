<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdministrator
{
    public function handle($request, Closure $next)
    { 
        // Pastikan user login dan memiliki role administrator
        if (Auth::check() && strtolower(Auth::user()->primary_role ?? '') === 'administrator') {
            return $next($request);
        }

        abort(403, 'Akses ditolak - Anda bukan Administrator.');
    }   
}
