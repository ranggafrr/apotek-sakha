<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        $authStatus = Session::get('loginStatus');

        // Jika user sudah login (status true), arahkan ke halaman lain
        if ($authStatus) {
            return redirect()->route('dashboard');  // Ganti dengan rute halaman yang sesuai
        }

        return $next($request);
    }
}
