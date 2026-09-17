<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;

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
            'slug' => 'required|string|max:255|unique:landing_pages,slug',
            'path' => 'required|string|max:255|unique:landing_pages,path',
            'category' => 'required|string',
            'heading' => 'nullable|string',
            'subheading' => 'nullable|string',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'primary_keyword' => 'nullable|string',
            'secondary_keywords' => 'nullable|array',
            'seo_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|string',
            'status' => 'required|string|in:draft,published',
            'published' => 'boolean',
        ]);

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
            'slug' => 'sometimes|required|string|max:255|unique:landing_pages,slug,' . $id,
            'path' => 'sometimes|required|string|max:255|unique:landing_pages,path,' . $id,
            'category' => 'sometimes|required|string',
            'heading' => 'nullable|string',
            'subheading' => 'nullable|string',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'primary_keyword' => 'nullable|string',
            'secondary_keywords' => 'nullable|array',
            'seo_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|string',
            'status' => 'sometimes|required|string|in:draft,published',
            'published' => 'boolean',
        ]);

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
