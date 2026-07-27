<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements RepositoryInterface
{
    public function all(): Collection
    {
        return Company::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function findBySlug(string $slug): ?Company
    {
        return Company::where('is_active', true)
            ->where('slug', $slug)
            ->with('seo')
            ->first();
    }
}
