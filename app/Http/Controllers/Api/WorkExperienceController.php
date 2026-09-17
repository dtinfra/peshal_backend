<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{
    public function index(): JsonResponse
    {
        $experiences = WorkExperience::orderBy('order', 'asc')->orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $experiences
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'role' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'duration_text' => 'required|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'required|string',
            'skills' => 'nullable|array',
            'order' => 'nullable|integer',
        ]);

        $experience = WorkExperience::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Work experience record created successfully.',
            'data' => $experience
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $experience = WorkExperience::findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'role' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'duration_text' => 'required|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'required|string',
            'skills' => 'nullable|array',
            'order' => 'nullable|integer',
        ]);

        $experience->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Work experience record updated successfully.',
            'data' => $experience
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $experience = WorkExperience::findOrFail($id);
        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Work experience record deleted successfully.'
        ]);
    }
}
