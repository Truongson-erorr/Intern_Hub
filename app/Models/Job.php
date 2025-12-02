<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    protected $fillable = [
        'title', 'description', 'category_id', 'employer_id',
        'location', 'salary', 'experience', 'candidate_requirements',
        'income', 'benefits', 'work_location', 'work_time',
        'application_method', 'deadline', 'degree_requirements'
    ];

    protected $casts = [
        'deadline' => 'date',
    ];
}
