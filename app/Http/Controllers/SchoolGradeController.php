<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolGradeRequest;
use App\Http\Requests\UpdateSchoolGradeRequest;
use App\Http\Resources\SchoolGradeResource;
use App\Models\SchoolGrade;

class SchoolGradeController extends Controller
{
    public function index()
    {
        return SchoolGradeResource::collection(SchoolGrade::all());
    }

    public function store(StoreSchoolGradeRequest $request)
    {
        $grade = SchoolGrade::create($request->validated());

        return (new SchoolGradeResource($grade))
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $grade = SchoolGrade::findOrFail($id);

        return new SchoolGradeResource($grade);
    }

    public function update(UpdateSchoolGradeRequest $request, string $id)
    {
        $grade = SchoolGrade::findOrFail($id);
        $grade->update($request->validated());

        return new SchoolGradeResource($grade);
    }

    public function destroy(string $id)
    {
        $grade = SchoolGrade::findOrFail($id);
        $grade->delete();

        return response()->json(['message' => 'Niveau scolaire supprimé.']);
    }
}