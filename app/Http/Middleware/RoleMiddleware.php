<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Cek role user
        if (auth()->user()->role !== $role) {

            // Redirect jika role tidak sesuai
            abort(403, 'AKSES DITOLAK');
        }

        return $next($request);
    }
}