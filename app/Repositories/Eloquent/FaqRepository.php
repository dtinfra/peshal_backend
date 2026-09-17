<?php

namespace App\Repositories\Eloquent;

use App\Models\Faq;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class FaqRepository implements RepositoryInterface
{
    public function all(): Collection
    {
        return Faq::orderBy('order')->get();
    }

    public function findBySlug(string $slug): ?Faq
    {
        return null; // FAQs do not use slugs
    }

    public function getByCategory(string $categoryKey): Collection
    {
        return Faq::where('category_key', $categoryKey)
            ->orWhere('page_slug', $categoryKey)
            ->orderBy('order')
            ->get();
    }

    public function getByPage(string $pageSlug): Collection
    {
        return Faq::where('page_slug', $pageSlug)
            ->orWhere('category_key', $pageSlug)
            ->orderBy('order')
            ->get();
    }
}
