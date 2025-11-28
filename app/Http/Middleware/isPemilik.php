<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isPemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && session('user_role') == 5) {
            return $next($request);
        }

        // Jika pengguna sudah login tapi bukan pemilik, kembalikan ke halaman sebelumnya.
        return back()->with('error', 'Anda tidak memiliki hak akses Pemilik.');
    }
}
