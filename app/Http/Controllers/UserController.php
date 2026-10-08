<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::withCount('posts')->paginate());
    }

    public function store(UserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return (new UserResource($user))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user->load('posts'));
    }

    public function update(UserRequest $request, User $user): UserResource
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return $this->jsonResponse(['message' => __('messages.user_deleted', ['id' => $user->id])], Response::HTTP_OK);
    }
}
