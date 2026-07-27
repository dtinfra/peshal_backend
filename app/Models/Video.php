<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'description',
    'youtube_url',
    'duration',
    'published_at'
])]
class Video extends Model
{
    protected $table = 'videos';

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}
