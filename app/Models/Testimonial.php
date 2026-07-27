<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'client_name',
    'client_image',
    'company_name',
    'position',
    'rating',
    'review',
    'video_url',
    'is_featured',
    'country'
])]
class Testimonial extends Model
{
    protected $table = 'testimonials';

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_featured' => 'boolean',
        ];
    }
}
