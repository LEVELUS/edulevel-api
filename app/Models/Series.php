<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Series extends Model
{
    protected $table = 'series';
    protected $primaryKey = 'series_id';
    public $timestamps = false;

    protected $fillable = ['series_name', 'code', 'grade_id'];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(SchoolGrade::class, 'grade_id', 'grade_id');
    }
}