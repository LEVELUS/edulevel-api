<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeriesRequest;
use App\Http\Requests\UpdateSeriesRequest;
use App\Http\Resources\SeriesResource;
use App\Models\Series;
use App\Models\SchoolGrade;

class SeriesController extends Controller
{
    public function index(string $gradeId)
    {
        $grade = SchoolGrade::findOrFail($gradeId);

        return SeriesResource::collection($grade->series);
    }

    public function store(StoreSeriesRequest $request, string $gradeId)
    {
        $grade = SchoolGrade::findOrFail($gradeId);

        $series = $grade->series()->create($request->validated());

        return (new SeriesResource($series))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateSeriesRequest $request, string $id)
    {
        $series = Series::findOrFail($id);
        $series->update($request->validated());

        return new SeriesResource($series);
    }

    public function destroy(string $id)
    {
        $series = Series::findOrFail($id);
        $series->delete();

        return response()->json(['message' => 'Filière supprimée.']);
    }
}