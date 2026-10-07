<?php

namespace App\Http\Controllers;

use App\Exceptions\EditTaskDoneException;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
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
        $tasks = Task::with(['project'])->latest()->get();
        return $this->jsonResponse(TaskResource::collection($tasks), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $data = $request->validated();
        $task = Task::create($data);

        return $this->jsonResponse(['message' => "Tâche créée", 'task' => TaskResource::make($task)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        return $this->jsonResponse(['task' => TaskResource::make($task)], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        if($task->status === 'done'){
            throw new EditTaskDoneException("Modification impossible pour une tâche terminée");
        }
        
        $data = $request->validated();
        $task->update($data);
        return $this->jsonResponse(['message' => "Tâche {$task->id} mise à jour", 'task' => TaskResource::make($task)], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->deleteOrFail();
        return $this->jsonResponse(['message' => "Tâche {$task->id} supprimée", 'task' => TaskResource::make($task)], Response::HTTP_OK);
    }
}
