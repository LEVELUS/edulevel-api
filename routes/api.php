<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolGradeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectLevelController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SeriesController;

// Routes publiques (sans token)
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Routes protégées (token obligatoire)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', function (Request $request) {
        return response()->json($request->user());
    });

    // Lecture : tout utilisateur connecté
    Route::get('school-grades', [SchoolGradeController::class, 'index']);
    Route::get('school-grades/{id}', [SchoolGradeController::class, 'show']);

    Route::get('subjects', [SubjectController::class, 'index']);
    Route::get('subjects/{id}', [SubjectController::class, 'show']);

    Route::get('subjects/{subjectId}/grades', [SubjectLevelController::class, 'index']);

    Route::get('questions', [QuestionController::class, 'index']);
    Route::get('questions/{id}', [QuestionController::class, 'show']);

    Route::get('school-grades/{gradeId}/series', [SeriesController::class, 'index']);

    // Écriture : admins uniquement
    Route::middleware('admin')->group(function () {
        Route::post('school-grades', [SchoolGradeController::class, 'store']);
        Route::put('school-grades/{id}', [SchoolGradeController::class, 'update']);
        Route::delete('school-grades/{id}', [SchoolGradeController::class, 'destroy']);

        Route::post('subjects', [SubjectController::class, 'store']);
        Route::put('subjects/{id}', [SubjectController::class, 'update']);
        Route::delete('subjects/{id}', [SubjectController::class, 'destroy']);

        Route::post('subjects/{subjectId}/grades', [SubjectLevelController::class, 'store']);
        Route::delete('subjects/{subjectId}/grades/{gradeId}', [SubjectLevelController::class, 'destroy']);

        Route::post('questions', [QuestionController::class, 'store']);
        Route::put('questions/{id}', [QuestionController::class, 'update']);
        Route::delete('questions/{id}', [QuestionController::class, 'destroy']);

        Route::post('school-grades/{gradeId}/series', [SeriesController::class, 'store']);
        Route::put('series/{id}', [SeriesController::class, 'update']);
        Route::delete('series/{id}', [SeriesController::class, 'destroy']);
    });
});