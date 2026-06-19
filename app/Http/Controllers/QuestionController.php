<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::query();

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('grade_id')) {
            $query->where('grade_id', $request->grade_id);
        }

        if ($request->filled('series_id')) {
            $query->where('series_id', $request->series_id);
        }

        return QuestionResource::collection($query->get());
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = Question::create($request->validated());

        return (new QuestionResource($question))
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $question = Question::findOrFail($id);

        return new QuestionResource($question);
    }

    public function update(UpdateQuestionRequest $request, string $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->validated());

        return new QuestionResource($question);
    }

    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(['message' => 'Question supprimée.']);
    }
}