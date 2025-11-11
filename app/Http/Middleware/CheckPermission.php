<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $permission
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect('login');
        }

        // Get the authenticated user
        $user = auth()->user();

        // Check permissions based on role
        switch ($permission) {
            case 'manage-users':
                if (!$user->canManageUsers()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
                
            case 'manage-reservations':
                if (!$user->canManageReservations()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
                
            case 'manage-invoices':
                if (!$user->canManageInvoices()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
                
            case 'modify-data':
                if (!$user->canModifyData()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
                
            default:
                abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}