<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'category',
        'logo',
        'description',
        'content',
        'website_url',
        'my_role',
        'locations',
        'technologies',
        'industries',
        'faqs',
        'order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'locations' => 'array',
        'technologies' => 'array',
        'industries' => 'array',
        'faqs' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function seo()
    {
        return $this->morphOne(SeoMetadata::class, 'model');
    }
}
