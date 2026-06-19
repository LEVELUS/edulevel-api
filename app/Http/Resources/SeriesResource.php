<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeriesResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->series_id,
            'name'     => $this->series_name,
            'code'     => $this->code,
            'grade_id' => $this->grade_id,
        ];
    }
}