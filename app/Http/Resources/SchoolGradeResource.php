<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolGradeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'   => $this->grade_id,
            'name' => $this->grade_name,
        ];
    }
}