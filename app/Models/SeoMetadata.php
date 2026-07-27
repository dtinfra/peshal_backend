<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable([
    'model_type',
    'model_id',
    'meta_title',
    'meta_description',
    'keywords',
    'canonical_url',
    'og_title',
    'og_description',
    'og_image',
    'twitter_card',
    'json_ld'
])]
class SeoMetadata extends Model
{
    protected $table = 'seo_metadata';

    protected function casts(): array
    {
        return [
            'json_ld' => 'array',
        ];
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
