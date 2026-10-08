<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Post::truncate();
        User::truncate();

        Schema::enableForeignKeyConstraints();

        $users = User::factory(5)->create();

        $posts = [
            ['title' => 'Débuter avec Laravel', 'content' => 'Installation et structure d\'un projet Laravel.'],
            ['title' => 'Les routes API', 'content' => 'Déclarer des routes REST avec apiResource.'],
            ['title' => 'Eloquent et les relations', 'content' => 'hasMany, belongsTo et belongsToMany.'],
            ['title' => 'Les migrations', 'content' => 'Créer et modifier les tables avec les migrations.'],
            ['title' => 'Consommer une API en JavaScript', 'content' => 'Appeler une API REST avec fetch.'],
            ['title' => 'Les nouveautés de PHP', 'content' => 'Les attributs, enums et readonly.'],
        ];

        foreach ($posts as $data) {
            Post::create([
                'user_id' => fake()->randomElement($users)->id,
                'title' => $data['title'],
                'content' => $data['content'],
                'published_at' => now(),
            ]);
        }
    }
}
