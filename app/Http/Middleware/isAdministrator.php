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

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('error', 'Anda tidak memiliki hak akses Administrator.');
    }
}