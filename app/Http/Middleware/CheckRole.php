<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika belum login sama sekali, arahkan ke login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Jika rolenya tidak cocok dengan yang diminta route
        if ($user->role !== $role) {
            return match ($user->role) {
                'admin' => redirect('/admin/dashboard'),
                'user' => redirect('/user/dashboard'),
                default => abort(403, 'Role pengguna tidak valid.'),
            };
        }

        return $next($request);
    }
}
