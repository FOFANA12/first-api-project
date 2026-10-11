<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Task::truncate();
        Project::truncate();
        Schema::enableForeignKeyConstraints();

        User::factory(2)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
        ]);

        $this->call([
            ProjectSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
