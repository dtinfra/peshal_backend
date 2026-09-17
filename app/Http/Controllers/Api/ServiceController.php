<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Repositories\Eloquent\ServiceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    protected ServiceRepository $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index(): JsonResponse
    {
        $services = $this->serviceRepository->all();
        return response()->json([
            'success' => true,
            'data' => ServiceResource::collection($services)
        ]);
    }

    public function featured(): JsonResponse
    {
        $services = $this->serviceRepository->getFeatured();
        return response()->json([
            'success' => true,
            'data' => ServiceResource::collection($services)
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $service = $this->serviceRepository->findBySlug($slug);

        if (!$service) {
            // Try fetching by ID for admin edit
            $service = Service::where('id', $slug)->with('seo')->first();
            if (!$service) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service not found.'
                ], 404);
            }
        }

        return response()->json([
            'success' => true,
            'data' => new ServiceResource($service)
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'seo' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $validated['description'] = $validated['description'] ?? $validated['title'];
        $validated['content'] = $validated['content'] ?? $validated['description'];
        $validated['icon'] = $validated['icon'] ?? 'briefcase';
        $validated['is_featured'] = $validated['is_featured'] ?? false;
        $validated['is_active'] = $validated['is_active'] ?? true;
        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(10, 99);

        $service = Service::create($validated);

        if (!empty($validated['seo'])) {
            $service->seo()->create([
                'meta_title' => $validated['seo']['meta_title'] ?? $service->title,
                'meta_description' => $validated['seo']['meta_description'] ?? $service->description,
                'keywords' => $validated['seo']['keywords'] ?? '',
                'canonical_url' => $validated['seo']['canonical_url'] ?? '',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Service created successfully.',
            'data' => new ServiceResource($service->load('seo'))
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $service = Service::where('id', $id)->orWhere('slug', $id)->first();
        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
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
        
        if (Service::where('slug', $validated['slug'])->where('id', '!=', $service->id)->exists()) {
            $validated['slug'] .= '-' . rand(10, 99);
        }

        $service->update($validated);

        if (!empty($validated['seo'])) {
            $service->seo()->updateOrCreate(
                ['model_type' => Service::class, 'model_id' => $service->id],
                [
                    'meta_title' => $validated['seo']['meta_title'] ?? $service->title,
                    'meta_description' => $validated['seo']['meta_description'] ?? $service->description,
                    'keywords' => $validated['seo']['keywords'] ?? '',
                    'canonical_url' => $validated['seo']['canonical_url'] ?? '',
                ]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully.',
            'data' => new ServiceResource($service->load('seo'))
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $service = Service::where('id', $id)->orWhere('slug', $id)->first();
        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found.'
            ], 404);
        }

        $service->seo()->delete();
        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully.'
        ]);
    }
}
