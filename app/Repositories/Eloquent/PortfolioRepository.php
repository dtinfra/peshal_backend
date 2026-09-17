<?php

namespace App\Repositories\Eloquent;

use App\Models\PortfolioProject;
use App\Models\CaseStudy;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PortfolioRepository implements RepositoryInterface
{
    public function all(): Collection
    {
        return PortfolioProject::orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getFeatured(): Collection
    {
        return PortfolioProject::where('is_featured', true)
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function findBySlug(string $slug): ?PortfolioProject
    {
        return PortfolioProject::where('slug', $slug)
            ->with(['caseStudy', 'seo'])
            ->first();
    }

    public function getCaseStudies(): Collection
    {
        return CaseStudy::orderBy('order')
            ->with('portfolioProject')
            ->get();
    }

    public function findCaseStudyBySlug(string $slug): ?CaseStudy
    {
        return CaseStudy::where('slug', $slug)
            ->with(['portfolioProject', 'seo'])
            ->first();
    }
}
