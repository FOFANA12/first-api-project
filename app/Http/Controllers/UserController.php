<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = User::latest()->get();
        return $this->jsonResponse($users, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::create($data);
        return $this->jsonResponse(['message' => "Utilisateur créé", 'user' => $user], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return $this->jsonResponse(['user' => $user], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
         $data = $request->validated();

        $user->update($data);
        return $this->jsonResponse(['message' => "Utilisateur {$user->id} mis à jour", 'user' => $user], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->deleteOrFail();
        return $this->jsonResponse(['message' => "Utilisateur {$user->id} supprimé", 'user' => $user], Response::HTTP_OK);
    }
}
