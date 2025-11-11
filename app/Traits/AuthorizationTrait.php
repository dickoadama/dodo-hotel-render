<?php

namespace App\Traits;

trait AuthorizationTrait
{
    /**
     * Check if the authenticated user is an administrator
     *
     * @return bool
     */
    public function isAdmin()
    {
        return auth()->check() && auth()->user()->isAdmin();
    }
    
    /**
     * Check if the authenticated user is an employee
     *
     * @return bool
     */
    public function isEmployee()
    {
        return auth()->check() && auth()->user()->isEmployee();
    }
    
    /**
     * Check if the authenticated user is a client
     *
     * @return bool
     */
    public function isClient()
    {
        return auth()->check() && auth()->user()->isClient();
    }
    
    /**
     * Check if the authenticated user can manage reservations
     *
     * @return bool
     */
    public function canManageReservations()
    {
        return auth()->check() && auth()->user()->canManageReservations();
    }
    
    /**
     * Check if the authenticated user can manage invoices
     *
     * @return bool
     */
    public function canManageInvoices()
    {
        return auth()->check() && auth()->user()->canManageInvoices();
    }
    
    /**
     * Check if the authenticated user can manage users
     *
     * @return bool
     */
    public function canManageUsers()
    {
        return auth()->check() && auth()->user()->canManageUsers();
    }
    
    /**
     * Check if the authenticated user can modify data
     *
     * @return bool
     */
    public function canModifyData()
    {
        return auth()->check() && auth()->user()->canModifyData();
    }
    
    /**
     * Abort if user doesn't have required permission
     *
     * @param string $permission
     * @return void
     */
    public function requirePermission($permission)
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }
        
        switch ($permission) {
            case 'manage-users':
                if (!$this->canManageUsers()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
                
            case 'manage-reservations':
                if (!$this->canManageReservations()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
                
            case 'manage-invoices':
                if (!$this->canManageInvoices()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
                
            case 'modify-data':
                if (!$this->canModifyData()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
                
            default:
                abort(403, 'Unauthorized action.');
        }
    }
}