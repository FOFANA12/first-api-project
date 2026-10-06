<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tasks = Task::latest()->get();
        return $this->jsonResponse($tasks, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $task = Task::create($request->all());

        return $this->jsonResponse(['message' => "Tâche créée", 'task' => $task], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        return $this->jsonResponse(['message' => "Tâche {$task->id} trouvée", 'task' => $task], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): JsonResponse
    {
        $task->update($request->all());
        return $this->jsonResponse(['message' => "Tâche {$task->id} mise à jour", 'task' => $task], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->deleteOrFail();
        return $this->jsonResponse(['message' => "Tâche {$task->id} supprimée", 'task' => $task], Response::HTTP_OK);
    }
}
