<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
    public function index(): JsonResponse
    {
        $resources = Resource::with('seo')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => ResourceResource::collection($resources)
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $resource = Resource::where('slug', $slug)
            ->orWhere('id', $slug)
            ->with('seo')
            ->first();

        if (!$resource) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new ResourceResource($resource)
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100', // Whitepaper, Guide, Report, Checklists, etc.
            'description' => 'nullable|string',
            'file_path' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_active' => 'required|boolean',
            'seo' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(10, 99);
        $validated['download_count'] = 0;

        $resource = Resource::create($validated);

        if (!empty($validated['seo'])) {
            $resource->seo()->create([
                'meta_title' => $validated['seo']['meta_title'] ?? $resource->title,
                'meta_description' => $validated['seo']['meta_description'] ?? substr(strip_tags($resource->description ?? ''), 0, 160),
                'keywords' => $validated['seo']['keywords'] ?? '',
                'canonical_url' => $validated['seo']['canonical_url'] ?? '',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Resource created successfully.',
            'data' => new ResourceResource($resource->load('seo'))
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $resource = Resource::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'file_path' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_active' => 'required|boolean',
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
        
        if (Resource::where('slug', $validated['slug'])->where('id', '!=', $resource->id)->exists()) {
            $validated['slug'] .= '-' . rand(10, 99);
        }

        $resource->update($validated);

        if (!empty($validated['seo'])) {
            $resource->seo()->updateOrCreate(
                ['model_type' => Resource::class, 'model_id' => $resource->id],
                [
                    'meta_title' => $validated['seo']['meta_title'] ?? $resource->title,
                    'meta_description' => $validated['seo']['meta_description'] ?? substr(strip_tags($resource->description ?? ''), 0, 160),
                    'keywords' => $validated['seo']['keywords'] ?? '',
                    'canonical_url' => $validated['seo']['canonical_url'] ?? '',
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Resource updated successfully.',
            'data' => new ResourceResource($resource->load('seo'))
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $resource = Resource::findOrFail($id);
        
        // Delete SEO metadata to prevent orphans
        $resource->seo()->delete();
        
        $resource->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resource deleted successfully.'
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
                'message' => 'No resource IDs provided.'
            ], 400);
        }

        // Delete associated SEO metadata first to avoid orphans
        \App\Models\SeoMetadata::where('model_type', Resource::class)
            ->whereIn('model_id', $ids)
            ->delete();

        // Delete resources
        Resource::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => count($ids) . ' resources deleted successfully.'
        ]);
    }

    public function download(string $id)
    {
        $resource = Resource::findOrFail($id);
        
        // Auto-increment downloaded value
        $resource->increment('download_count');
        
        $filePath = $resource->file_path;
        
        if (filter_var($filePath, FILTER_VALIDATE_URL)) {
            return redirect()->away($filePath);
        }
        
        $cleanPath = ltrim($filePath, '/');
        $publicFilePath = public_path($cleanPath);
        if (file_exists($publicFilePath) && is_file($publicFilePath)) {
            return response()->download($publicFilePath);
        }
        
        if (str_starts_with($filePath, '/storage')) {
            $storageCleanPath = substr($filePath, 9);
            $storagePath = storage_path('app/public/' . $storageCleanPath);
            if (file_exists($storagePath) && is_file($storagePath)) {
                return response()->download($storagePath);
            }
        }
        
        return redirect()->away(url($filePath));
    }

    public function uploadFile(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $filename, 'public');
            
            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully.',
                'file_path' => '/storage/' . $path
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No file uploaded.'
        ], 400);
    }
}
