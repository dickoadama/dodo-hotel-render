<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_their_profile()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
        $response->assertSee('Mon Profil');
    }

    /** @test */
    public function user_can_update_their_profile()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($user)->put('/profile', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'city' => 'Paris',
            'country' => 'France',
            'date_of_birth' => '1990-01-01',
            'gender' => 'male',
            'bio' => 'This is my bio'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'city' => 'Paris',
            'country' => 'France',
            'gender' => 'male',
            'bio' => 'This is my bio'
        ]);
    }

    /** @test */
    public function user_can_update_their_password()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'password',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword'
        ]);

        $response->assertStatus(302);
        $this->assertTrue(Hash::check('newpassword', $user->fresh()->password));
    }

    /** @test */
    public function user_cannot_update_password_with_wrong_current_password()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'wrongpassword',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['current_password']);
        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}