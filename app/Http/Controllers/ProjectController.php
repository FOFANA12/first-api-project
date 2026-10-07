<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
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
        $projects = Project::with(['tasks'])->latest()->get();
        return $this->jsonResponse(ProjectResource::collection($projects), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request): JsonResponse
    {
        $data = $request->validated();
        $project = Project::create($data);
        return $this->jsonResponse(['message' => "Projet créé", 'project' => ProjectResource::make($project)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): JsonResponse
    {
        return $this->jsonResponse(['project' => ProjectResource::make($project)], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project): JsonResponse
    {
        $data = $request->validated();
        $project->update($data);
        return $this->jsonResponse(['message' => "Projet {$project->id} mis à jour", 'project' => ProjectResource::make($project)], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        $project->deleteOrFail();
        return $this->jsonResponse(['message' => "Projet {$project->id} supprimé", 'project' => ProjectResource::make($project)], Response::HTTP_OK);
    }
}
