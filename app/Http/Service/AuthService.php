<?php

namespace App\Http\Service;

use App\Exceptions\InvalidCredentials;
use App\Models\User;
use DateTimeImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class AuthService
{
    /**
     * @return string $token
     */
    public function createUserAndReturnToken(string $name, string $email, string $password): string
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => new DateTimeImmutable()
        ]);

        return $user->createToken('auth_token')->plainTextToken;
    }

     /**
     * @return string $token
     */
    public function checkUserAndReturnToken(string $email, string $password): string
    {
        $canLogin = Auth::attempt([
            'email' => $email, 
            'password' => $password
        ]);
        if (!$canLogin) {
            throw new InvalidCredentials();
        }

        $user = User::where('email', $email)
            ->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $token;
    }
}