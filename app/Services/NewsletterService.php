<?php

namespace App\Services;

use App\Models\NewsletterSubscriber;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Log;

class NewsletterService
{
    public function subscribe(string $email): NewsletterSubscriber
    {
        $subscriber = NewsletterSubscriber::updateOrCreate(
            ['email' => $email],
            ['is_active' => true]
        );

        AuditLog::create([
            'action' => 'NEWSLETTER_SUBSCRIBE',
            'description' => "Newsletter subscription for {$email}",
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        // Mock mailchimp or active campaign integrations
        Log::info("Integration: Synced subscriber {$email} to Mailchimp mailing list");

        return $subscriber;
    }
}
