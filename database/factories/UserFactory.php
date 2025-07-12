<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenoms' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'contact' => $this->faker->unique()->phoneNumber(),
            'password' => bcrypt('password'), // mot de passe par défaut
            'type' => 'client',
            'remember_token' => Str::random(10),
        ];
    }
}
