<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolGrade extends Model
{
    protected $table = 'school_grades';
    protected $primaryKey = 'grade_id';
    public $timestamps = false;

    protected $fillable = ['grade_name'];
}