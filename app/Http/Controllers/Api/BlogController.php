<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Services\BlogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected BlogService $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index(Request $request): JsonResponse
    {
        if ($request->has('search')) {
            $blogs = $this->blogService->searchBlogs($request->get('search'));
        } elseif ($request->has('category')) {
            $blogs = $this->blogService->getBlogsByCategory($request->get('category'));
        } elseif ($request->has('tag')) {
            $blogs = $this->blogService->getBlogsByTag($request->get('tag'));
        } else {
            // Support fetching draft posts for admin list
            if ($request->has('admin_list')) {
                $perPage = (int) $request->get('per_page', 200);
                $blogs = Blog::with(['author', 'category', 'tags', 'seo'])
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);
            } else {
                $blogs = $this->blogService->getPaginatedBlogs();
            }
        }

        return response()->json([
            'success' => true,
            'data' => BlogResource::collection($blogs),
            'meta' => [
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
                'per_page' => $blogs->perPage(),
                'total' => $blogs->total(),
            ]
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $blog = $this->blogService->getBlogBySlug($slug);

        if (!$blog) {
            // Try fetching by ID or slug including draft for admin edit
            $blog = Blog::where('slug', $slug)->orWhere('id', $slug)->with(['author', 'category', 'tags', 'seo'])->first();
            if (!$blog) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found.'
                ], 404);
            }
        }

        $related = $this->blogService->getRelatedBlogs($blog);

        return response()->json([
            'success' => true,
            'data' => new BlogResource($blog),
            'related' => BlogResource::collection($related)
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string|max:255',
            'featured_image_alt' => 'nullable|string|max:255',
            'author_id' => 'required|exists:blog_authors,id',
            'category_id' => 'nullable|required_without:new_category_name|exists:blog_categories,id',
            'new_category_name' => 'nullable|string|max:255',
            'is_published' => 'required|boolean',
            'reading_time' => 'nullable|integer',
            'tags' => 'nullable|array',
            'seo' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);

        // Dynamically find or create the category
        if (!empty($request->new_category_name)) {
            $newCat = \App\Models\BlogCategory::firstOrCreate(
                ['name' => $request->new_category_name],
                ['slug' => Str::slug($request->new_category_name)]
            );
            $validated['category_id'] = $newCat->id;
        }

        $blog = Blog::create($validated);

        if (!empty($validated['tags'])) {
            $blog->tags()->sync($validated['tags']);
        }

        if (!empty($validated['seo'])) {
            $blog->seo()->create([
                'meta_title' => $validated['seo']['meta_title'] ?? $blog->title,
                'meta_description' => $validated['seo']['meta_description'] ?? $blog->summary,
                'keywords' => $validated['seo']['keywords'] ?? '',
                'canonical_url' => $validated['seo']['canonical_url'] ?? '',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Article created successfully.',
            'data' => new BlogResource($blog->load(['author', 'category', 'tags', 'seo']))
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $blog = Blog::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string|max:255',
            'featured_image_alt' => 'nullable|string|max:255',
            'author_id' => 'required|exists:blog_authors,id',
            'category_id' => 'nullable|required_without:new_category_name|exists:blog_categories,id',
            'new_category_name' => 'nullable|string|max:255',
            'is_published' => 'required|boolean',
            'reading_time' => 'nullable|integer',
            'tags' => 'nullable|array',
            'seo' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $validated['slug'] = Str::slug($validated['title']);
        
        // Ensure slug is unique but not conflicting with itself
        if (Blog::where('slug', $validated['slug'])->where('id', '!=', $blog->id)->exists()) {
            $validated['slug'] .= '-' . rand(100, 999);
        }

        // Dynamically find or create the category
        if (!empty($request->new_category_name)) {
            $newCat = \App\Models\BlogCategory::firstOrCreate(
                ['name' => $request->new_category_name],
                ['slug' => Str::slug($request->new_category_name)]
            );
            $validated['category_id'] = $newCat->id;
        }

        $blog->update($validated);

        if (isset($validated['tags'])) {
            $blog->tags()->sync($validated['tags']);
        }

        if (!empty($validated['seo'])) {
            $blog->seo()->updateOrCreate(
                ['model_type' => Blog::class, 'model_id' => $blog->id],
                [
                    'meta_title' => $validated['seo']['meta_title'] ?? $blog->title,
                    'meta_description' => $validated['seo']['meta_description'] ?? $blog->summary,
                    'keywords' => $validated['seo']['keywords'] ?? '',
                    'canonical_url' => $validated['seo']['canonical_url'] ?? '',
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Article updated successfully.',
            'data' => new BlogResource($blog->load(['author', 'category', 'tags', 'seo']))
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article deleted successfully.'
        ]);
    }

    public function bulkDestroy(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $ids = $request->input('ids');
        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No article IDs provided.'
            ], 400);
        }

        // Delete associated SEO metadata first to avoid orphans
        \App\Models\SeoMetadata::where('model_type', Blog::class)
            ->whereIn('model_id', $ids)
            ->delete();

        // Delete blogs (cascades tag pivot tables)
        Blog::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' articles deleted successfully.'
        ]);
    }

    public function categories(): JsonResponse
    {
        $categories = $this->blogService->getCategories();
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    public function tags(): JsonResponse
    {
        $tags = $this->blogService->getTags();
        return response()->json([
            'success' => true,
            'data' => $tags
        ]);
    }
}
