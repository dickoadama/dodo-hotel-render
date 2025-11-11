<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_access_user_management()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->get('/users');
        $response->assertStatus(200);
    }

    /** @test */
    public function employee_cannot_access_user_management()
    {
        $employee = User::create([
            'name' => 'Employee User',
            'email' => 'employee@test.com',
            'password' => bcrypt('password'),
            'role' => 'employee'
        ]);

        $response = $this->actingAs($employee)->get('/users');
        $response->assertStatus(403);
    }

    /** @test */
    public function client_cannot_access_user_management()
    {
        $client = User::create([
            'name' => 'Client User',
            'email' => 'client@test.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($client)->get('/users');
        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_manage_reservations()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin2@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->get('/reservations');
        $response->assertStatus(200);
    }

    /** @test */
    public function employee_can_manage_reservations()
    {
        $employee = User::create([
            'name' => 'Employee User',
            'email' => 'employee2@test.com',
            'password' => bcrypt('password'),
            'role' => 'employee'
        ]);

        $response = $this->actingAs($employee)->get('/reservations');
        $response->assertStatus(200);
    }

    /** @test */
    public function client_cannot_manage_reservations()
    {
        $client = User::create([
            'name' => 'Client User',
            'email' => 'client2@test.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($client)->get('/reservations');
        $response->assertStatus(403);
    }
}