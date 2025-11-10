<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class Role
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            abort(403, 'You must be logged in.');
        }
        // dd(Auth::user()->role);
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
