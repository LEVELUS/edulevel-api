<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectLevelRequest;
use App\Http\Resources\SchoolGradeResource;
use App\Models\Subject;

class SubjectLevelController extends Controller
{
    // Lister les niveaux où cette matière est disponible
    public function index(string $subjectId)
    {
        $subject = Subject::findOrFail($subjectId);

        return SchoolGradeResource::collection($subject->grades);
    }

    // Associer la matière à un niveau
    public function store(StoreSubjectLevelRequest $request, string $subjectId)
    {
        $subject = Subject::findOrFail($subjectId);
        $gradeId = $request->validated()['grade_id'];

        // Éviter un doublon (la clé composite lèverait une erreur SQL sinon)
        if ($subject->grades()->where('school_grades.grade_id', $gradeId)->exists()) {
            return response()->json([
                'message' => 'Cette matière est déjà disponible à ce niveau.'
            ], 409);
        }

        $subject->grades()->attach($gradeId);

        return response()->json([
            'message' => 'Matière associée au niveau avec succès.'
        ], 201);
    }

    // Retirer l'association
    public function destroy(string $subjectId, string $gradeId)
    {
        $subject = Subject::findOrFail($subjectId);

        $detached = $subject->grades()->detach($gradeId);

        if ($detached === 0) {
            return response()->json([
                'message' => 'Cette association n\'existe pas.'
            ], 404);
        }

        return response()->json([
            'message' => 'Association supprimée.'
        ]);
    }
}