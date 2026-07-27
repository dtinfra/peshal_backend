<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title',
    'slug',
    'description',
    'audio_url',
    'duration',
    'spotify_url',
    'apple_podcast_url',
    'published_at'
])]
class Podcast extends Model
{
    protected $table = 'podcasts';

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}
