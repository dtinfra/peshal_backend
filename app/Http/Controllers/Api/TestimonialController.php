<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function index(): JsonResponse
    {
        $testimonials = Testimonial::orderBy('is_featured', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => TestimonialResource::collection($testimonials)
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'client_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'video_url' => 'nullable|url',
            'is_featured' => 'required|boolean',
            'country' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $testimonial = Testimonial::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Testimonial created successfully.',
            'data' => new TestimonialResource($testimonial)
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $testimonial = Testimonial::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'client_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'video_url' => 'nullable|url',
            'is_featured' => 'required|boolean',
            'country' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $testimonial->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Testimonial updated successfully.',
            'data' => new TestimonialResource($testimonial)
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return response()->json([
            'success' => true,
            'message' => 'Testimonial deleted successfully.'
        ]);
    }
}
