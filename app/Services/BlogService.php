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
        $perPage = (int) request()->get('per_page', $perPage);
        return $this->blogRepository->paginate($perPage);
    }

    public function getBlogBySlug(string $slug): ?Blog
    {
        return $this->blogRepository->findBySlug($slug);
    }

    public function getRelatedBlogs(Blog $blog, int $limit = 3): Collection
    {
        return $this->blogRepository->getRelated($blog, $limit);
    }

    public function getBlogsByCategory(string $categorySlug, int $perPage = 50): LengthAwarePaginator
    {
        $perPage = (int) request()->get('per_page', $perPage);
        return $this->blogRepository->getByCategory($categorySlug, $perPage);
    }

    public function getBlogsByTag(string $tagSlug, int $perPage = 50): LengthAwarePaginator
    {
        $perPage = (int) request()->get('per_page', $perPage);
        return $this->blogRepository->getByTag($tagSlug, $perPage);
    }

    public function searchBlogs(string $term, int $perPage = 50): LengthAwarePaginator
    {
        $perPage = (int) request()->get('per_page', $perPage);
        return $this->blogRepository->search($term, $perPage);
    }

    public function getCategories(): Collection
    {
        return $this->blogRepository->getCategories();
    }

    public function getTags(): Collection
    {
        return $this->blogRepository->getTags();
    }
}
