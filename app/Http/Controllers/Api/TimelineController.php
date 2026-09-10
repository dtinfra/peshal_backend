<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TimelineEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index(): JsonResponse
    {
        $events = TimelineEvent::where('is_published', true)->orderBy('order', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'year' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image_url' => 'nullable|string|max:255',
            'evidence_url' => 'nullable|string|max:255',
            'venture_id' => 'nullable|exists:ventures,id',
            'order' => 'nullable|integer',
            'is_published' => 'boolean',
        ]);

        $event = TimelineEvent::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Timeline event created successfully.',
            'data' => $event
        ], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $event = TimelineEvent::findOrFail($id);

        $validated = $request->validate([
            'year' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image_url' => 'nullable|string|max:255',
            'evidence_url' => 'nullable|string|max:255',
            'venture_id' => 'nullable|exists:ventures,id',
            'order' => 'nullable|integer',
            'is_published' => 'boolean',
        ]);

        $event->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Timeline event updated successfully.',
            'data' => $event
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $event = TimelineEvent::findOrFail($id);
        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Timeline event deleted successfully.'
        ]);
    }
}
