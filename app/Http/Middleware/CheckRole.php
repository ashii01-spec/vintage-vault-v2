<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is logged in AND has the correct role
        if (! $request->user() || $request->user()->role !== $role) {
            // If not, redirect them to the dashboard with an error
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
