<?php

namespace Tests\Feature\Api\Controller;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testUserCanRegister()
    {
        $data = [
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'password' => $this->faker->password(minLength: 8)
        ];
        $this->postJson('/api/register', $data)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'access_token',
                'token_type'
            ]);
    }

    public function testUserCanLogin()
    {
        $password = $this->faker->password;
        $user = User::factory()
            ->create([
                'password' => Hash::make($password)
            ]);
        
        $data = [
            'email' => $user->email,
            'password' => $password
        ];
        $this->postJson('/api/login', $data)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'access_token',
                'token_type'
            ]);
    }
}






