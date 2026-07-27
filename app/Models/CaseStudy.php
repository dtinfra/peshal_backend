<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'portfolio_project_id',
    'title',
    'slug',
    'problem',
    'solution',
    'technology',
    'approach',
    'timeline_duration',
    'challenges',
    'results',
    'roi_percentage',
    'order'
])]
class CaseStudy extends Model
{
    use HasSeo;

    protected $table = 'case_studies';

    protected function casts(): array
    {
        return [
            'technology' => 'array',
            'roi_percentage' => 'float',
            'order' => 'integer',
        ];
    }

    public function portfolioProject(): BelongsTo
    {
        return $this->belongsTo(PortfolioProject::class, 'portfolio_project_id');
    }
}
