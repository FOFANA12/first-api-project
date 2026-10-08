<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_post_returns_formatted_resource(): void
    {
        $user = User::factory()->create();

        $this->postJson('/api/posts', [
            'user_id' => $user->id,
            'title' => 'Hello',
            'content' => 'World',
        ])
            ->assertCreated()
            ->assertJsonPath('data.title', 'Hello')
            ->assertJsonPath('data.is_published', false)
            ->assertJsonPath('data.author.email', $user->email)
            ->assertJsonMissingPath('data.author.password');
    }

    public function test_validation_errors_are_translated_in_french(): void
    {
        $this->postJson('/api/posts', [], ['Accept-Language' => 'fr'])
            ->assertUnprocessable()
            ->assertJsonPath('errors.title.0', 'Le champ titre est obligatoire.');
    }

    public function test_validation_errors_are_translated_in_english(): void
    {
        $this->postJson('/api/posts', [], ['Accept-Language' => 'en'])
            ->assertUnprocessable()
            ->assertJsonPath('errors.title.0', 'The title field is required.');
    }

    public function test_unique_email_is_validated_on_user_update(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $data = ['name' => 'Nouveau nom', 'password' => 'secret123', 'password_confirmation' => 'secret123'];

        $this->putJson("/api/users/{$user->id}", [...$data, 'email' => $user->email])->assertOk();
        $this->putJson("/api/users/{$user->id}", [...$data, 'email' => $other->email])->assertJsonValidationErrors('email');
    }

    public function test_index_is_paginated(): void
    {
        User::factory()->count(3)->create();

        $this->getJson('/api/users')
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure(['data' => [['id', 'name', 'email', 'posts_count']], 'links', 'meta']);
    }

    public function test_destroy_and_not_found_messages_are_translated(): void
    {
        $post = Post::create(['user_id' => User::factory()->create()->id, 'title' => 'T', 'content' => 'C']);

        $this->deleteJson("/api/posts/{$post->id}", [], ['Accept-Language' => 'en'])
            ->assertOk()
            ->assertJsonPath('message', "Post {$post->id} deleted.");

        $this->getJson("/api/posts/{$post->id}", ['Accept-Language' => 'fr'])
            ->assertNotFound()
            ->assertJsonPath('message', 'Ressource introuvable.');
    }

    public function test_post_update_requires_all_fields(): void
    {
        $user = User::factory()->create();
        $post = Post::create(['user_id' => $user->id, 'title' => 'Titre', 'content' => 'C']);

        $this->putJson("/api/posts/{$post->id}", ['user_id' => $user->id, 'title' => 'Nouveau', 'content' => 'C'])
            ->assertOk()
            ->assertJsonPath('data.title', 'Nouveau');

        $this->putJson("/api/posts/{$post->id}", ['title' => 'Nouveau'])
            ->assertJsonValidationErrors(['user_id', 'content']);
    }
}
