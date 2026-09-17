<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        $query = LandingPage::query();

        if ($request->has('category')) {
            $query->where('category', $request->query('category'));
        }

        // Non-admin requests only get published landing pages
        if (!$request->user()) {
            $query->where('published', true)->where('status', 'published');
        }

        return response()->json([
            'success' => true,
            'data' => $query->get()
        ]);
    }

    public function showByPath(Request $request)
    {
        $path = $request->query('path');
        $slug = $request->query('slug');

        $query = LandingPage::query();

        if ($path) {
            $normalizedPath = '/' . trim($path, '/') . '/';
            $page = $query->where('path', $normalizedPath)->orWhere('path', rtrim($normalizedPath, '/'))->first();
        } elseif ($slug) {
            $page = $query->where('slug', $slug)->first();
        } else {
            return response()->json(['success' => false, 'message' => 'Path or slug required'], 400);
        }

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Landing page not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $page
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'path' => 'nullable|string|max:255',
            'category' => 'required|string',
            'heading' => 'nullable|string',
            'subheading' => 'nullable|string',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'primary_keyword' => 'nullable|string',
            'secondary_keywords' => 'nullable|array',
            'search_intent' => 'nullable|string',
            'target_location' => 'nullable|string',
            'parent_topic' => 'nullable|string',
            'seo_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|string',
            'og_title' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string',
            'schema_type' => 'nullable|string',
            'status' => 'required|string|in:draft,review,published,archived',
            'related_ventures' => 'nullable|array',
            'related_case_studies' => 'nullable|array',
            'related_articles' => 'nullable|array',
            'internal_links' => 'nullable|array',
            'sections' => 'nullable|array',
            'redirect_url' => 'nullable|string',
            'faqs' => 'nullable|array',
            'published' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $count = 1;
            while (LandingPage::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }
            $validated['slug'] = $slug;
        }

        if (empty($validated['path'])) {
            $cat = trim($validated['category'] ?? 'business-consulting', '/');
            if ($cat === 'standalone' || $cat === 'custom' || empty($cat)) {
                $basePath = '/' . $validated['slug'] . '/';
            } else {
                $basePath = '/' . $cat . '/' . $validated['slug'] . '/';
            }
            $validated['path'] = $basePath;
        } else {
            $validated['path'] = '/' . trim($validated['path'], '/') . '/';
        }

        if (isset($validated['status'])) {
            $validated['published'] = ($validated['status'] === 'published');
        }

        $page = LandingPage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Landing page created successfully',
            'data' => $page
        ]);
    }

    public function update(Request $request, $id)
    {
        $page = LandingPage::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'path' => 'nullable|string|max:255',
            'category' => 'sometimes|required|string',
            'heading' => 'nullable|string',
            'subheading' => 'nullable|string',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'primary_keyword' => 'nullable|string',
            'secondary_keywords' => 'nullable|array',
            'search_intent' => 'nullable|string',
            'target_location' => 'nullable|string',
            'parent_topic' => 'nullable|string',
            'seo_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|string',
            'og_title' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string',
            'schema_type' => 'nullable|string',
            'status' => 'sometimes|required|string|in:draft,review,published,archived',
            'related_ventures' => 'nullable|array',
            'related_case_studies' => 'nullable|array',
            'related_articles' => 'nullable|array',
            'internal_links' => 'nullable|array',
            'sections' => 'nullable|array',
            'redirect_url' => 'nullable|string',
            'faqs' => 'nullable|array',
            'published' => 'boolean',
        ]);

        if (array_key_exists('slug', $validated) && empty($validated['slug']) && !empty($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if (array_key_exists('path', $validated) && !empty($validated['path'])) {
            $validated['path'] = '/' . trim($validated['path'], '/') . '/';
        }

        if (isset($validated['status'])) {
            $validated['published'] = ($validated['status'] === 'published');
        }

        $page->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Landing page updated successfully',
            'data' => $page
        ]);
    }

    public function destroy($id)
    {
        $page = LandingPage::findOrFail($id);
        $page->delete();

        return response()->json([
            'success' => true,
            'message' => 'Landing page deleted successfully'
        ]);
    }
}
