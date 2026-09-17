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
        'status',
        'logo',
        'favicon',
        'cover_image',
        'description',
        'content',
        'website_url',
        'my_role',
        'locations',
        'founded_date',
        'founder',
        'services',
        'industries',
        'technologies',
        'target_market',
        'primary_keyword',
        'secondary_keywords',
        'seo_title',
        'meta_description',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'schema_type',
        'social_links',
        'contact_information',
        'case_studies',
        'projects',
        'articles',
        'testimonials',
        'related_expertise',
        'related_ventures',
        'faqs',
        'order',
        'is_featured',
        'is_active',
        'published',
    ];

    protected $casts = [
        'locations' => 'array',
        'services' => 'array',
        'technologies' => 'array',
        'industries' => 'array',
        'secondary_keywords' => 'array',
        'social_links' => 'array',
        'contact_information' => 'array',
        'case_studies' => 'array',
        'projects' => 'array',
        'articles' => 'array',
        'testimonials' => 'array',
        'related_expertise' => 'array',
        'related_ventures' => 'array',
        'faqs' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true)->where('status', 'published');
    }

    public function seo()
    {
        return $this->morphOne(SeoMetadata::class, 'model');
    }
}
