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
                    'Scaling IntechNexus remote software engineering squads for US & EU SaaS companies',
                    'Expanding Answer Engine Optimization (AEO/GEO) capabilities inside Digital Terai',
                    'Refining 360Castle Dubai property matching system for international buyers',
                ],
                'exploring' => [
                    'Nepal market entry frameworks for foreign founders and tech companies',
                    'Dubai business ecosystem growth and cross-border tech ventures',
                    'AI-assisted workflow automation for software engineering teams',
                ],
                'learning' => [
                    'Next.js 15 App Router server actions & edge caching patterns',
                    'LLM fine-tuning techniques for domain-specific answer engines',
                ],
                'reading' => [
                    'The Lean Startup by Eric Ries',
                    'Zero to One by Peter Thiel',
                    'High Output Management by Andrew Grove',
                ],
                'history' => [
                    [
                        'period' => 'Q1 2026',
                        'title' => 'Launched Master SEO & AEO Ecosystem',
                        'category' => 'Milestone',
                        'description' => 'Published 10 priority AEO hubs and integrated AI answer citation engines across Digital Terai and BeinSEO Dubai.'
                    ],
                    [
                        'period' => '2025',
                        'title' => 'Scaled IntechNexus Remote Squads',
                        'category' => 'Expansion',
                        'description' => 'Built dedicated agile development squads in Kathmandu for US, Swiss, and Australian B2B SaaS clients.'
                    ],
                    [
                        'period' => '2022',
                        'title' => 'Expanded Operations to Dubai, UAE',
                        'category' => 'Venture',
                        'description' => 'Established BeinSEO Dubai and 360Castle real estate advisory footprint in the Middle East.'
                    ],
                    [
                        'period' => '2019',
                        'title' => 'Founded Digital Terai Agency',
                        'category' => 'Venture',
                        'description' => 'Built premier performance search marketing agency in Nepal, scaling organic SEO and B2B growth.'
                    ]
                ],
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

        $input = $request->all();

        foreach (['building', 'exploring', 'learning', 'reading'] as $field) {
            if (isset($input[$field])) {
                if (is_string($input[$field])) {
                    $input[$field] = array_values(array_filter(array_map('trim', explode("\n", $input[$field]))));
                } elseif (is_array($input[$field])) {
                    $input[$field] = array_values(array_filter(array_map('trim', $input[$field])));
                }
            }
        }

        if (isset($input['history'])) {
            if (is_string($input['history'])) {
                $decoded = json_decode($input['history'], true);
                if (is_array($decoded)) {
                    $input['history'] = $decoded;
                }
            }
        }

        $now->update([
            'building' => $input['building'] ?? $now->building ?? [],
            'exploring' => $input['exploring'] ?? $now->exploring ?? [],
            'learning' => $input['learning'] ?? $now->learning ?? [],
            'reading' => $input['reading'] ?? $now->reading ?? [],
            'history' => $input['history'] ?? $now->history ?? [],
            'current_focus' => $input['current_focus'] ?? $now->current_focus ?? 'Building digital ecosystems in Nepal & Dubai.',
            'last_updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Now page updated successfully.',
            'data' => $now
        ]);
    }
}
