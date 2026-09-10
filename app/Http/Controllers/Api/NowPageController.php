<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NowPageSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NowPageController extends Controller
{
    public function show(): JsonResponse
    {
        $now = NowPageSetting::firstOrCreate(
            ['id' => 1],
            [
                'building' => [
                    'Scaling IntechNexus remote dev squads',
                    'Expanding AEO Search optimization inside Digital Terai',
                    'Developing 360Castle Dubai property matching tools'
                ],
                'exploring' => ['Nepal business market entry frameworks', 'Dubai venture expansion opportunities'],
                'learning' => ['Next.js 15 App Router Edge optimization', 'LLM fine-tuning pipelines'],
                'reading' => ['The Lean Startup', 'Zero to One', 'High Output Management'],
                'current_focus' => 'Building businesses across technology, digital growth, travel, and real estate.',
                'last_updated_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'data' => $now
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $now = NowPageSetting::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'building' => 'nullable|array',
            'exploring' => 'nullable|array',
            'learning' => 'nullable|array',
            'reading' => 'nullable|array',
            'current_focus' => 'required|string',
        ]);

        $validated['last_updated_at'] = now();
        $now->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Now page updated successfully.',
            'data' => $now
        ]);
    }
}
