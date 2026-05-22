<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika user belum login, redirect ke login
        if (!Auth::check()) {
            return redirect()->route('account.login');
        }

        // Jika role tidak cocok, redirect ke dashboard masing-masing
        if (!in_array(Auth::user()->role, $roles)) {
            return match (Auth::user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'customer' => redirect()->route('user.dashboard'),
                default => redirect()->route('account.login'),
            };
        }

        return $next($request);
    }
}
