<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolGrade extends Model
{
    protected $table = 'school_grades';
    protected $primaryKey = 'grade_id';
    public $timestamps = false;

    protected $fillable = ['grade_name'];

    public function series(): HasMany
    {
        return $this->hasMany(Series::class, 'grade_id', 'grade_id');
    }
}