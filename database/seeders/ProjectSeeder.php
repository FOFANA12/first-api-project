<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Site e-commerce',
                'description' => 'Développement d’une plateforme de vente en ligne.',
            ],
            [
                'name' => 'Application de gestion de tâches',
                'description' => 'Application permettant de créer, modifier et suivre des tâches.',
            ],
            [
                'name' => 'Plateforme de réservation',
                'description' => 'Système de réservation en ligne pour des services.',
            ],
            [
                'name' => 'Portfolio professionnel',
                'description' => 'Création d’un portfolio pour présenter des projets et compétences.',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
