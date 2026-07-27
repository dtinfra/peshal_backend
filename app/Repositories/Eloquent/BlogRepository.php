<?php

namespace App\Repositories\Eloquent;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogRepository implements RepositoryInterface
{
    public function all(): Collection
    {
        return Blog::where('is_published', true)
            ->with(['author', 'category', 'tags', 'seo'])
            ->orderBy('published_at', 'desc')
            ->get();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Blog::where('is_published', true)
            ->with(['author', 'category', 'tags', 'seo'])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function findBySlug(string $slug): ?Blog
    {
        return Blog::where('slug', $slug)
            ->with(['author', 'category', 'tags', 'seo'])
            ->first();
    }

    public function getByCategory(string $categorySlug, int $perPage = 10): LengthAwarePaginator
    {
        return Blog::where('is_published', true)
            ->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            })
            ->with(['author', 'category', 'tags', 'seo'])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function getByTag(string $tagSlug, int $perPage = 10): LengthAwarePaginator
    {
        return Blog::where('is_published', true)
            ->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            })
            ->with(['author', 'category', 'tags', 'seo'])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function search(string $term, int $perPage = 10): LengthAwarePaginator
    {
        return Blog::where('is_published', true)
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                  ->orWhere('summary', 'like', "%{$term}%")
                  ->orWhere('content', 'like', "%{$term}%");
            })
            ->with(['author', 'category', 'tags', 'seo'])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function getRelated(Blog $blog, int $limit = 3): Collection
    {
        return Blog::where('is_published', true)
            ->where('id', '!=', $blog->id)
            ->where(function ($q) use ($blog) {
                $q->where('category_id', $blog->category_id)
                  ->orWhereHas('tags', function ($t) use ($blog) {
                      $t->whereIn('blog_tags.id', $blog->tags->pluck('id'));
                  });
            })
            ->with(['author', 'category', 'tags'])
            ->limit($limit)
            ->get();
    }

    public function getCategories(): Collection
    {
        return BlogCategory::withCount(['blogs' => function ($q) {
            $q->where('is_published', true);
        }])->orderBy('order')->get();
    }

    public function getTags(): Collection
    {
        return BlogTag::all();
    }
}
