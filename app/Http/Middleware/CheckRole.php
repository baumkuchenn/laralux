<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->route('/login');
        }

        $user = Auth::user();

        if (in_array($user->role, $roles)) {
            // Jika peran pengguna sesuai, lanjutkan permintaan
            return $next($request);
        }

        if ($user->role == 'customer') {
            // Jika peran pengguna adalah customer, arahkan ke halaman index customer
            return redirect()->route('hotel.index');
        }

        if (in_array($user->role, ['owner', 'staff'])) {
            // Jika peran pengguna adalah owner atau staff, arahkan ke halaman employee mode
            return redirect()->route('hotel.index');
        }

        // Jika peran pengguna tidak sesuai dengan aturan apa pun, arahkan ke halaman utama
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
