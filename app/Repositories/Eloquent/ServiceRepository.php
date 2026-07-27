<?php

namespace App\Repositories\Eloquent;

use App\Models\Service;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository implements RepositoryInterface
{
    public function all(): Collection
    {
        return Service::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public function getFeatured(): Collection
    {
        return Service::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->get();
    }

    public function findBySlug(string $slug): ?Service
    {
        return Service::where('is_active', true)
            ->where('slug', $slug)
            ->with('seo')
            ->first();
    }
}
