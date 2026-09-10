<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'phone_whatsapp' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:100',
            'lead_category' => 'nullable|string|max:100',
            'budget_range' => 'nullable|string|max:100',
            'timeline' => 'nullable|string|max:100',
            'message' => 'required|string',
            'service_requested' => 'nullable|string|max:255',
            'appointment_time' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        // Determine Lead Routing
        $cat = strtolower($validated['lead_category'] ?? '');
        $routedTo = 'peshal_team';
        if (in_array($cat, ['software_ai', 'software', 'ai', 'saas', 'product_development', 'remote_teams'])) {
            $routedTo = 'intechnexus';
        } elseif (in_array($cat, ['digital_growth', 'seo', 'performance_marketing', 'ai_marketing'])) {
            $routedTo = 'digitalterai';
        } elseif (in_array($cat, ['travel', 'nepal_travel', 'luxury_tours'])) {
            $routedTo = 'nepaltrippackages';
        } elseif (in_array($cat, ['real_estate', 'dubai_property', 'dubai_villas'])) {
            $routedTo = '360castle';
        }

        $validated['routed_to'] = $routedTo;
        $validated['status'] = 'new';

        $lead = ContactRequest::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your inquiry. Your message has been received and routed to our executive team.',
            'data' => $lead
        ], 201);
    }
}
