<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isDokter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && session('user_role') == 2) {
            return $next($request);
        }

        // Jika bukan dokter, kembalikan ke halaman sebelumnya.
        return back()->with('error', 'Anda tidak memiliki hak akses Dokter.');
    }
}
