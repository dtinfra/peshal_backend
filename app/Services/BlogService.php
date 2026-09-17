<?php

namespace App\Services;

use App\Models\Blog;
use App\Repositories\Eloquent\BlogRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class BlogService
{
    protected BlogRepository $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function getPaginatedBlogs(int $perPage = 50): LengthAwarePaginator
    {
        $page = request()->get('page', 1);
        $perPage = (int) request()->get('per_page', $perPage);
        return Cache::remember("blogs_page_{$page}_per_{$perPage}", 3600, function () use ($perPage) {
            return $this->blogRepository->paginate($perPage);
        });
    }

    public function getBlogBySlug(string $slug): ?Blog
    {
        return Cache::remember("blog_slug_{$slug}", 3600, function () use ($slug) {
            return $this->blogRepository->findBySlug($slug);
        });
    }

    public function getRelatedBlogs(Blog $blog, int $limit = 3): Collection
    {
        return Cache::remember("blog_related_{$blog->id}_limit_{$limit}", 3600, function () use ($blog, $limit) {
            return $this->blogRepository->getRelated($blog, $limit);
        });
    }

    public function getBlogsByCategory(string $categorySlug, int $perPage = 50): LengthAwarePaginator
    {
        $page = request()->get('page', 1);
        $perPage = (int) request()->get('per_page', $perPage);
        return Cache::remember("blogs_cat_{$categorySlug}_page_{$page}_per_{$perPage}", 3600, function () use ($categorySlug, $perPage) {
            return $this->blogRepository->getByCategory($categorySlug, $perPage);
        });
    }

    public function getBlogsByTag(string $tagSlug, int $perPage = 50): LengthAwarePaginator
    {
        $page = request()->get('page', 1);
        $perPage = (int) request()->get('per_page', $perPage);
        return Cache::remember("blogs_tag_{$tagSlug}_page_{$page}_per_{$perPage}", 3600, function () use ($tagSlug, $perPage) {
            return $this->blogRepository->getByTag($tagSlug, $perPage);
        });
    }

    public function searchBlogs(string $term, int $perPage = 50): LengthAwarePaginator
    {
        $perPage = (int) request()->get('per_page', $perPage);
        return $this->blogRepository->search($term, $perPage);
    }

    public function getCategories(): Collection
    {
        return Cache::remember("blog_categories_all", 3600, function () {
            return $this->blogRepository->getCategories();
        });
    }

    public function getTags(): Collection
    {
        return Cache::remember("blog_tags_all", 3600, function () {
            return $this->blogRepository->getTags();
        });
    }
}
