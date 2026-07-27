<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'company_name',
    'logo',
    'role',
    'location',
    'type',
    'duration_text',
    'start_date',
    'end_date',
    'description',
    'skills',
    'order'
])]
class WorkExperience extends Model
{
    protected $table = 'work_experiences';

    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'start_date' => 'date',
            'end_date' => 'date',
            'order' => 'integer',
        ];
    }
}
