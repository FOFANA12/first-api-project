<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $projects = Project::latest()->get();
        return $this->jsonResponse($projects, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $project = Project::create($request->all());
        return $this->jsonResponse(['message' => "Projet créé", 'project' => $project], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): JsonResponse
    {
        return $this->jsonResponse(['project' => $project], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): JsonResponse
    {
        $project->update($request->all());
        return $this->jsonResponse(['message' => "Projet {$project->id} mis à jour", 'project' => $project], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        $project->deleteOrFail();
        return $this->jsonResponse(['message' => "Projet {$project->id} supprimé", 'project' => $project], Response::HTTP_OK);
    }
}
