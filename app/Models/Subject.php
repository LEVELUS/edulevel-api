<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'subject_id';
    public $timestamps = false;

    protected $fillable = ['subject_name', 'description'];

    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(
            SchoolGrade::class,
            'subject_levels', // la table pivot
            'subject_id',     // clé de CE model dans le pivot
            'grade_id',       // clé du model lié dans le pivot
            'subject_id',     // clé primaire de CE model
            'grade_id'        // clé primaire du model lié
        );
    }
}