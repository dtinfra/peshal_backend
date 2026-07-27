<?php

namespace App\Services;

use App\Models\ContactRequest;
use App\Models\AuditLog;
use App\Mail\ContactRequestMail;
use Illuminate\Support\Facades\Mail;
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

        // Send email notification to owner
        try {
            $settingsPath = storage_path('app/settings.json');
            $settings = file_exists($settingsPath) ? json_decode(file_get_contents($settingsPath), true) : [];
            $toEmail = $settings['notification_email'] ?? env('CONTACT_NOTIFICATION_EMAIL', 'hi@peshalb.com.np');

            Mail::to($toEmail)->send(new ContactRequestMail($request));
            Log::info("Notification: Sent contact request email to {$toEmail}");
        } catch (\Exception $e) {
            Log::error("Failed to send contact request email notification: " . $e->getMessage());
        }

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
