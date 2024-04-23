<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Check if the user's role is admin
            if (Auth::user()->role === 'admin') {
                // User is admin, allow access
                return $next($request);
            }
        }

        // If not admin, redirect or return error as needed
        return redirect()->route('login')->with('error', 'Unauthorized access');
    }
}
