<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect('login');
        }

        // Get the authenticated user
        $user = auth()->user();

        // If no roles specified, allow access
        if (empty($roles)) {
            return $next($request);
        }

        // Check if user has any of the required roles
        if ($user->isAdmin()) {
            // Admin has access to everything
            return $next($request);
        }

        if (in_array('employee', $roles) && $user->isEmployee()) {
            return $next($request);
        }

        if (in_array('client', $roles) && $user->isClient()) {
            return $next($request);
        }

        // If we get here, the user doesn't have the required role
        abort(403, 'Unauthorized action.');
    }
}