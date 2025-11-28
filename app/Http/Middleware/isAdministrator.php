<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdministrator
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && session('user_role') == 1) {
            return $next($request);
        }

        // Jika pengguna sudah login tapi bukan admin, kembalikan ke halaman sebelumnya.
        return back()->with('error', 'Anda tidak memiliki hak akses Administrator.');
    }
}