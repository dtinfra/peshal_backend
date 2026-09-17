<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'path',
        'category',
        'heading',
        'subheading',
        'summary',
        'content',
        'primary_keyword',
        'secondary_keywords',
        'search_intent',
        'target_location',
        'parent_topic',
        'seo_title',
        'meta_description',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'schema_type',
        'status',
        'related_ventures',
        'related_case_studies',
        'related_articles',
        'internal_links',
        'sections',
        'redirect_url',
        'faqs',
        'published',
    ];

    protected $casts = [
        'secondary_keywords' => 'array',
        'related_ventures' => 'array',
        'related_case_studies' => 'array',
        'related_articles' => 'array',
        'internal_links' => 'array',
        'sections' => 'array',
        'faqs' => 'array',
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
