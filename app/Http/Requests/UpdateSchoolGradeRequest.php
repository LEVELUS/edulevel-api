<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSchoolGradeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'grade_name' => [
                'required', 'string', 'max:100',
                Rule::unique('school_grades', 'grade_name')
                    ->ignore($this->route('id'), 'grade_id'),
            ],
        ];
    }
}