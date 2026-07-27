<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'institution_name',
    'logo',
    'degree',
    'study_field',
    'grade',
    'duration_text',
    'start_year',
    'end_year',
    'description'
])]
class EducationRecord extends Model
{
    protected $table = 'education_records';

    protected function casts(): array
    {
        return [
            'start_year' => 'integer',
            'end_year' => 'integer',
        ];
    }
}
