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
        $query = Venture::where('is_active', true)->orderBy('order', 'asc');

        if ($request->has('category')) {
            $query->where('category', $request->get('category'));
        }

        $ventures = $query->get();

        return response()->json([
            'success' => true,
            'data' => $ventures
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $venture = Venture::where('slug', $slug)->with('seo')->firstOrFail();

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
            'category' => 'required|string|max:100',
            'logo' => 'nullable|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'website_url' => 'nullable|url',
            'my_role' => 'nullable|string|max:255',
            'locations' => 'nullable|array',
            'technologies' => 'nullable|array',
            'industries' => 'nullable|array',
            'faqs' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $venture = Venture::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Venture created successfully.',
            'data' => $venture
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $venture = Venture::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'category' => 'required|string|max:100',
            'logo' => 'nullable|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'website_url' => 'nullable|url',
            'my_role' => 'nullable|string|max:255',
            'locations' => 'nullable|array',
            'technologies' => 'nullable|array',
            'industries' => 'nullable|array',
            'faqs' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $venture->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Venture updated successfully.',
            'data' => $venture
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $venture = Venture::findOrFail($id);
        $venture->delete();

        return response()->json([
            'success' => true,
            'message' => 'Venture deleted successfully.'
        ]);
    }
}
