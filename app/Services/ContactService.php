<?php

namespace App\Services;

use App\Models\ContactRequest;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Log;

class ContactService
{
    public function storeRequest(array $data): ContactRequest
    {
        $request = ContactRequest::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'company' => $data['company'] ?? null,
            'message' => $data['message'] ?? null,
            'service_requested' => $data['service_requested'] ?? null,
            'appointment_time' => isset($data['appointment_time']) ? \Carbon\Carbon::parse($data['appointment_time']) : null,
            'status' => 'pending',
            'notes' => $data['notes'] ?? null,
        ]);

        // Create audit log for security tracking
        AuditLog::create([
            'action' => 'CONTACT_REQUEST_RECEIVED',
            'description' => "Received contact request from {$request->name} ({$request->email})",
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'payload' => $request->toArray()
        ]);

        // Trigger third-party integrations (Mock logs for Hubspot, Zapier, Google Calendar)
        $this->triggerThirdPartyWebhooks($request);

        return $request;
    }

    protected function triggerThirdPartyWebhooks(ContactRequest $request): void
    {
        Log::info("Integration: Synced lead to HubSpot CRM for {$request->email}");
        Log::info("Integration: Dispatched webhook to Zapier for lead {$request->id}");
        if ($request->appointment_time) {
            Log::info("Integration: Scheduled Google Calendar Event on {$request->appointment_time}");
        }
    }
}
