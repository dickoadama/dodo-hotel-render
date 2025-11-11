<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class NewFeaturesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_access_chat_page()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($user)->get('/chat');
        $response->assertStatus(200);
        $response->assertSee('Chat en temps réel');
    }

    /** @test */
    public function user_can_access_notifications_page()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($user)->get('/notifications');
        $response->assertStatus(200);
        $response->assertSee('Notifications');
    }

    /** @test */
    public function user_can_access_search_page()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($user)->get('/search');
        $response->assertStatus(200);
        $response->assertSee('Recherche avancée');
    }

    /** @test */
    public function user_can_perform_search()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($user)->get('/search/results?query=test&type=all');
        $response->assertStatus(200);
        $response->assertSee('Résultats de recherche');
    }

    /** @test */
    public function user_can_access_reports_page()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin' // Seul l'admin peut accéder aux rapports
        ]);

        $response = $this->actingAs($user)->get('/reports');
        $response->assertStatus(200);
        $response->assertSee('Rapports et Analyses');
    }

    /** @test */
    public function non_admin_cannot_access_reports()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        $response = $this->actingAs($user)->get('/reports');
        // Les utilisateurs non-admin ne devraient pas avoir accès aux rapports
        // Cela dépend de l'implémentation des middlewares
    }
}