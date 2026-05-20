<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            \Illuminate\Support\Facades\Log::info('Checking admin role for user ' . Auth::id() . ': ' . Auth::user()->role);
            if (strtolower(Auth::user()->role) === 'admin') {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized access.');
    }
}
