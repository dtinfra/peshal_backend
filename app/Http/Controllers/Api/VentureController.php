<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VentureController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Venture::query();

        // If explicitly requested active only for public front-end
        if ($request->has('active_only')) {
            $query->where('is_active', true);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->get('category'));
        }

        $ventures = $query->orderBy('order', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $ventures
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $venture = Venture::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $venture
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'logo' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'website_url' => 'nullable|string',
            'my_role' => 'nullable|string|max:255',
            'locations' => 'nullable|array',
            'technologies' => 'nullable|array',
            'industries' => 'nullable|array',
            'faqs' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['category'] = $validated['category'] ?? 'technology';
        $validated['description'] = $validated['description'] ?? ($validated['name'] . ' venture and business operation.');
        $validated['my_role'] = $validated['my_role'] ?? 'Founder';
        $validated['is_active'] = isset($validated['is_active']) ? (bool)$validated['is_active'] : true;
        $validated['is_featured'] = isset($validated['is_featured']) ? (bool)$validated['is_featured'] : true;
        $validated['order'] = $validated['order'] ?? 0;

        if (empty($validated['website_url'])) {
            $validated['website_url'] = null;
        }

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $count = 1;
            while (Venture::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }
            $validated['slug'] = $slug;
        }

        $venture = Venture::create($validated);
        \Illuminate\Support\Facades\Cache::flush();

        return response()->json([
            'success' => true,
            'message' => 'Venture created successfully.',
            'data' => $venture
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $venture = Venture::where('id', $id)->orWhere('slug', $id)->firstOrFail();

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'logo' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'website_url' => 'nullable|string',
            'my_role' => 'nullable|string|max:255',
            'locations' => 'nullable|array',
            'technologies' => 'nullable|array',
            'industries' => 'nullable|array',
            'faqs' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        if (array_key_exists('website_url', $validated) && empty($validated['website_url'])) {
            $validated['website_url'] = null;
        }

        if (isset($validated['name']) && empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $venture->update($validated);
        \Illuminate\Support\Facades\Cache::flush();

        return response()->json([
            'success' => true,
            'message' => 'Venture updated successfully.',
            'data' => $venture
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $venture = Venture::where('id', $id)->orWhere('slug', $id)->first();
        if (!$venture) {
            return response()->json([
                'success' => false,
                'message' => 'Venture not found.'
            ], 404);
        }

        $venture->delete();
        \Illuminate\Support\Facades\Cache::flush();

        return response()->json([
            'success' => true,
            'message' => 'Venture deleted successfully.'
        ]);
    }
}
