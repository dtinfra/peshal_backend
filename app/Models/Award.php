<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'organization',
    'year',
    'description',
    'image'
])]
class Award extends Model
{
    protected $table = 'awards';

    protected function casts(): array
    {
        return [
            'year' => 'integer',
        ];
    }
}
