<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        return SubjectResource::collection(Subject::all());
    }

    public function store(StoreSubjectRequest $request)
    {
        $subject = Subject::create($request->validated());

        return (new SubjectResource($subject))
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $subject = Subject::findOrFail($id);

        return new SubjectResource($subject);
    }

    public function update(UpdateSubjectRequest $request, string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($request->validated());

        return new SubjectResource($subject);
    }

    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return response()->json(['message' => 'Matière supprimée.']);
    }
}