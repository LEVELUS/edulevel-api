<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->question_id,
            'subject_id'    => $this->subject_id,
            'grade_id'      => $this->grade_id,
            'content'       => $this->content,
            'question_type' => $this->question_type,
            'difficulty'    => $this->difficulty,
            'points'        => $this->points,
        ];
    }
}