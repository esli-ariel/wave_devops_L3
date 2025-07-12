<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

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

        $response->assertRedirect('/administrateur');

        $this->assertDatabaseHas('users', [
            'email' => 'jean.dupont@example.com',
            'contact' => '0707070707',
            'type' => 'client',
        ]);
    }

    public function test_login()
    {
        $user = User::factory()->create([
            'nom' => 'Dupont',
            'prenoms' => 'Jean',
            'contact' => '0707070707',
            'password' => bcrypt('secret123'),
            'type' => 'client',
        ]);

        $response = $this->post('/login', [
            'contact' => '0707070707',
            'password' => 'secret123',
        ]);

        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors();
    }
}
