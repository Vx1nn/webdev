<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsPerawat
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            abort(403, 'Akses ditolak - harap login terlebih dahulu.');
        }

        $user = Auth::user();
        
        if ($this->isPerawat($user)) {
            return $next($request);
        }

        abort(403, 'Akses ditolak - Anda bukan Perawat.');
    }

    private function isPerawat($user): bool
    {
        $roleName = 'perawat';
        
        // Method 1: Check if hasActiveRole method exists
        if (method_exists($user, 'hasActiveRole')) {
            return $user->hasActiveRole($roleName);
        }

        // Method 2: Check primary_role attribute
        if (property_exists($user, 'primary_role') || method_exists($user, 'getPrimaryRoleAttribute')) {
            $primaryRole = strtolower($user->primary_role ?? $user->getPrimaryRoleAttribute() ?? '');
            return $primaryRole === $roleName;
        }

        // Method 3: Direct database check
        return $user->roles()
            ->where('nama_role', $roleName)
            ->wherePivot('status', 1)
            ->exists();
    }
}