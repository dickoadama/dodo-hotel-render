<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'first_name',
        'last_name',
        'phone',
        'address',
        'city',
        'country',
        'date_of_birth',
        'gender',
        'bio',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
    ];
    
    /**
     * Automatically hash password when setting it
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    
    /**
     * Get the user's full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if ($this->first_name && $this->last_name) {
            return $this->first_name . ' ' . $this->last_name;
        }
        return $this->name;
    }
    
    /**
     * Check if the user is an administrator
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    /**
     * Check if the user is an employee
     *
     * @return bool
     */
    public function isEmployee()
    {
        return $this->role === 'employee';
    }
    
    /**
     * Check if the user is a client
     *
     * @return bool
     */
    public function isClient()
    {
        return $this->role === 'client';
    }
    
    /**
     * Check if the user can manage reservations
     *
     * @return bool
     */
    public function canManageReservations()
    {
        return $this->role === 'admin' || $this->role === 'employee';
    }
    
    /**
     * Check if the user can manage invoices
     *
     * @return bool
     */
    public function canManageInvoices()
    {
        return $this->role === 'admin' || $this->role === 'employee';
    }
    
    /**
     * Check if the user can manage users (admin only)
     *
     * @return bool
     */
    public function canManageUsers()
    {
        return $this->role === 'admin';
    }
    
    /**
     * Check if the user can modify data (admin only)
     *
     * @return bool
     */
    public function canModifyData()
    {
        return $this->role === 'admin';
    }
}