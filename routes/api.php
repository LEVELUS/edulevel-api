<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolGradeController;

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

    // Écriture : admins uniquement
    Route::middleware('admin')->group(function () {
        Route::post('school-grades', [SchoolGradeController::class, 'store']);
        Route::put('school-grades/{id}', [SchoolGradeController::class, 'update']);
        Route::delete('school-grades/{id}', [SchoolGradeController::class, 'destroy']);
    });
});