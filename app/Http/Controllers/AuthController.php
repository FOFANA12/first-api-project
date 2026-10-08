<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Identifiants incorrects']
            ]);
        }

        $user->last_login = now();
        $user->save();

        $tokenName = $request->input('token_name', 'api-token');
        $token = $user->createToken($tokenName)->plainTextToken;

        return $this->jsonResponse([
            'user' => UserResource::make($user),
            'token' => $token,
            'token_type' => 'Bearer'
        ], Response::HTTP_OK);
    }


    public function logout(Request $request): JsonResponse {
        $request->user()->currentAccessToken()->delete();

        return $this->jsonResponse(['message' => 'Déconnexion réussie.'], Response::HTTP_OK);
    }

    public function me(Request $request): JsonResponse {
        return $this->jsonResponse([
            'user' => UserResource::make($request->user())
        ],  Response::HTTP_OK);
    }

}
