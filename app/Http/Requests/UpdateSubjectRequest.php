<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject_name' => [
                'required', 'string', 'max:150',
                Rule::unique('subjects', 'subject_name')
                    ->ignore($this->route('id'), 'subject_id'),
            ],
            'description' => 'nullable|string',
        ];
    }
}