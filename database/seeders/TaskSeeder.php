<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Créer la page d’accueil',
                'description' => 'Développer la structure principale de la page d’accueil.',
                'status' => 'pending',
            ],
            [
                'title' => 'Configurer la base de données',
                'description' => 'Créer et configurer les tables nécessaires.',
                'status' => 'done',
            ],
            [
                'title' => 'Créer le formulaire de connexion',
                'description' => 'Mettre en place le formulaire d’authentification.',
                'status' => 'in_progress',
            ],
            [
                'title' => 'Développer le CRUD des projets',
                'description' => 'Ajouter la création, lecture, modification et suppression des projets.',
                'status' => 'pending',
            ],
            [
                'title' => 'Ajouter la validation des formulaires',
                'description' => 'Valider les données envoyées par les utilisateurs.',
                'status' => 'in_progress',
            ],
            [
                'title' => 'Créer les routes API',
                'description' => 'Définir les routes nécessaires pour l’API.',
                'status' => 'done',
            ],
            [
                'title' => 'Tester les endpoints',
                'description' => 'Vérifier le fonctionnement des différents endpoints.',
                'status' => 'pending',
            ],
            [
                'title' => 'Ajouter la pagination',
                'description' => 'Mettre en place la pagination sur la liste des tâches.',
                'status' => 'pending',
            ],
            [
                'title' => 'Corriger les bugs',
                'description' => 'Identifier et corriger les erreurs détectées.',
                'status' => 'in_progress',
            ],
            [
                'title' => 'Préparer le déploiement',
                'description' => 'Configurer l’application pour la mise en production.',
                'status' => 'pending',
            ],
        ];

        $projects = Project::all();

        foreach($tasks as $task) {
            Task::create([
                ...$task,
                'project_id' => fake()->randomElement($projects)->id
            ]);
        }
    }
}
