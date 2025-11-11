<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserRolesPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_view_roles_page()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->get('/roles');
        $response->assertStatus(200);
        $response->assertSee('Rôles et Permissions');
        $response->assertSee('Administrateur');
        $response->assertSee('Employé');
        $response->assertSee('Client');
    }

    /** @test */
    public function employee_can_view_roles_page()
    {
        $employee = User::create([
            'name' => 'Employee User',
            'email' => 'employee@test.com',
            'password' => bcrypt('password'),
            'role' => 'employee'
        ]);

        $response = $this->actingAs($employee)->get('/roles');
        $response->assertStatus(200);
        $response->assertSee('Rôles et Permissions');
    }

    /** @test */
    public function client_can_view_roles_page()
    {
        $client = User::create([
            'name' => 'Client User',
            'email' => 'client@test.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($client)->get('/roles');
        $response->assertStatus(200);
        $response->assertSee('Rôles et Permissions');
    }

    /** @test */
    public function guest_cannot_view_roles_page()
    {
        $response = $this->get('/roles');
        $response->assertStatus(302); // Redirection vers login
    }
}