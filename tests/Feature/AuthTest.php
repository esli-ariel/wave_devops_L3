<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    public function test_registration()
    {
        $response = $this->post('/users', [
            'nom' => 'Dupont',
            'prenoms' => 'Jean',
            'email' => 'jean.dupont@example.com',
            'contact' => '0707070707',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'type' => 'client',
        ]);

        // ⚠️ Laravel te redirige probablement vers /inscription après POST
        $response->assertStatus(302); // Ne vérifie pas le chemin ici

        $this->assertDatabaseHas('users', [
            'email' => 'jean.dupont@example.com',
            'contact' => '0707070707',
            'type' => 'client',
        ]);
    }

    public function test_login()
    {
        $user = User::create([
            'nom' => 'Dupont',
            'prenoms' => 'Jean',
            'email' => 'test@example.com',
            'contact' => '0707070707',
            'password' => Hash::make('secret123'),
            'type' => 'client',
        ]);

        $response = $this->post('/login', [
            'contact' => '0707070707',
            'password' => 'secret123',
        ]);

        $response->assertStatus(302); // attend une redirection après connexion réussie
        $this->assertAuthenticatedAs($user); // vérifie si connecté
    }
}
