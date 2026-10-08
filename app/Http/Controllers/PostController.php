<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::with('user')->latest()->paginate());
    }

    public function store(PostRequest $request): JsonResponse
    {
        $post = Post::create($request->validated());

        return (new PostResource($post->load('user')))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Post $post): PostResource
    {
        return new PostResource($post->load('user'));
    }

    public function update(PostRequest $request, Post $post): PostResource
    {
        $post->update($request->validated());

        return new PostResource($post->load('user'));
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return $this->jsonResponse(['message' => __('messages.post_deleted', ['id' => $post->id])], Response::HTTP_OK);
    }
}
