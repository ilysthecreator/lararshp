<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isResepsionis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && session('user_role') == 4) {
            return $next($request);
        }

        // Jika bukan resepsionis, kembalikan ke halaman sebelumnya.
        return back()->with('error', 'Anda tidak memiliki hak akses Resepsionis.');
    }
}
