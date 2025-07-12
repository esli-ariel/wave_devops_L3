<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase; // Reset la BDD à chaque test

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

        $response->assertRedirect('/administrateur'); // selon ton code

        $this->assertDatabaseHas('users', [
            'email' => 'jean.dupont@example.com',
            'contact' => '0707070707',
            'type' => 'client',
        ]);
    }

    public function test_login()
    {
        // Créer un utilisateur manuellement
        $user = User::factory()->create([
            'contact' => '0707070707',
            'password' => bcrypt('secret123'),
        ]);

        $response = $this->post('/login', [
            'contact' => '0707070707',
            'password' => 'secret123',
        ]);

        // Selon ta logique, ça redirige où ?
        $response->assertStatus(302);
        $response->assertSessionDoesntHaveErrors();
        // Par exemple vers administrateur
    }
}
