<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Service\AuthService;
use Illuminate\Http\Response;

final class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
        
    }

    public function register(RegisterRequest $request)
    {
        $token = $this->authService->createUserAndReturnToken(
            $request->name,
            $request->email, 
            $request->password
        );

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $token = $this->authService->checkUserAndReturnToken($request->email, $request->password);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
