<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject_id'    => 'required|integer|exists:subjects,subject_id',
            'grade_id'      => 'required|integer|exists:school_grades,grade_id',
            'content'       => 'required|string',
            'question_type' => 'sometimes|in:mcq,single_choice,true_false,open',
            'difficulty'    => 'sometimes|in:easy,medium,hard',
            'points'        => 'sometimes|integer|min:1',
        ];
    }
}