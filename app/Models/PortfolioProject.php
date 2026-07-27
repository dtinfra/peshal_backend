<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'title',
    'slug',
    'client_name',
    'summary',
    'content',
    'main_image',
    'gallery',
    'technologies',
    'business_outcomes',
    'results_summary',
    'website_url',
    'is_featured',
    'order'
])]
class PortfolioProject extends Model
{
    use HasSeo;

    protected $table = 'portfolio_projects';

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'technologies' => 'array',
            'business_outcomes' => 'array',
            'is_featured' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function caseStudy(): HasOne
    {
        return $this->hasOne(CaseStudy::class, 'portfolio_project_id');
    }
}
