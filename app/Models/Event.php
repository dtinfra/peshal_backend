<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'type',
    'description',
    'event_date',
    'location',
    'link',
    'is_speaking'
])]
class Event extends Model
{
    protected $table = 'events';

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_speaking' => 'boolean',
        ];
    }
}
