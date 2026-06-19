<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSeriesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'series_name' => 'required|string|max:150',
            'code' => [
                'nullable', 'string', 'max:20',
                Rule::unique('series', 'code')->where('grade_id', $this->route('gradeId')),
            ],
        ];
    }
}