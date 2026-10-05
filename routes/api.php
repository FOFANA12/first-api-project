<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Projects
Route::get('/projects', function () {
    return response()->json(['message' => 'Liste des projets'], 200);
});

Route::get('/projects/{id}', function ($id) {
    return response()->json(['message' => "Projet $id trouvé"], 200);
});

Route::post('/projects', function () {
    return response()->json(['message' => 'Projet créé'], 201);
});

Route::put('/projects/{id}', function ($id) {
    return response()->json(['message' => "Projet $id mis à jour"], 200);
});

Route::delete('/projects/{id}', function ($id) {
    return response()->json(['message' => "Projet $id supprimé"], 200);
});

// Tasks
Route::get('/tasks', function () {
    return response()->json(['message' => 'Liste des tâches'], 200);
});

Route::get('/tasks/{id}', function ($id) {
    return response()->json(['message' => "Tâche $id trouvée"], 200);
});

Route::post('/tasks', function () {
    return response()->json(['message' => 'Tâche créée'], 201);
});

Route::put('/tasks/{id}', function ($id) {
    return response()->json(['message' => "Tâche $id mise à jour"], 200);
});

Route::delete('/tasks/{id}', function ($id) {
    return response()->json(['message' => "Tâche $id supprimée"], 200);
});

// Users
Route::get('/users', function () {
    return response()->json(['message' => 'Liste des utilisateurs'], 200);
});

Route::get('/users/{id}', function ($id) {
    return response()->json(['message' => "Utilisateur $id trouvé"], 200);
});

Route::post('/users', function () {
    return response()->json(['message' => 'Utilisateur créé'], 201);
});

Route::put('/users/{id}', function ($id) {
    return response()->json(['message' => "Utilisateur $id mis à jour"], 200);
});

Route::delete('/users/{id}', function ($id) {
    return response()->json(['message' => "Utilisateur $id supprimé"], 200);
});
