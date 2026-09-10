<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\Api\CommonController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\VentureController;
use App\Http\Controllers\Api\TimelineController;
use App\Http\Controllers\Api\NowPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Helper Cache Clear
Route::get('/clear-route-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return 'All caches cleared successfully!';
});

// Auth Endpoints
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Public settings fetch
Route::get('/settings', function() {
    $path = storage_path('app/settings.json');
    $defaultSettings = [
        'gsc_verification' => 'google-site-verification-placeholder',
        'bing_verification' => '',
        'ga4_id' => 'G-GFEBQYX1P4',
        'canonical_base' => 'https://www.peshalb.com.np',
        'meta_title' => 'Peshal Bhattarai | Technology Leader & Business Consultant',
        'meta_description' => 'Venture Builder, Digital Transformation Consultant, Agile Coach, Product Strategist, and Technology Executive with over 10 years of enterprise IT leadership experience.',
        'whatsapp_number' => '+9779841517234',
        'telegram_link' => 'https://t.me/+9779841517234',
        'contact_email' => 'peshal@intechnexus.com',
        'contact_phone' => '+977-9841517234',
        'social_linkedin' => 'https://www.linkedin.com/in/peshalbhattarai/',
        'social_twitter' => '',
        'social_medium' => '',
        'social_github' => '',
        'webmail_url' => 'https://saphire.mysecurecloudserver.com:2096/cpsess0670920787/3rdparty/roundcube/?_task=mail&_mbox=INBOX',
        'calendar_public_url' => 'http://mail.peshalb.com.np:2079/calendars/hi@peshalb.com.np/calendar',
        'meeting_link' => 'https://meet.google.com/pb-mock-link',
        'notification_email' => 'hi@peshalb.com.np'
    ];

    if (!file_exists($path)) {
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, json_encode($defaultSettings, JSON_PRETTY_PRINT));
    }

    $settings = json_decode(file_get_contents($path), true);
    return response()->json([
        'success' => true,
        'data' => $settings
    ]);
});

// Public Reads
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/categories', [BlogController::class, 'categories']);
Route::get('/blogs/tags', [BlogController::class, 'tags']);
Route::get('/blogs/{slug}', [BlogController::class, 'show']);

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/featured', [ServiceController::class, 'featured']);
Route::get('/services/{slug}', [ServiceController::class, 'show']);

Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{slug}', [CompanyController::class, 'show']);

Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/portfolio/featured', [PortfolioController::class, 'featured']);
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show']);
Route::get('/case-studies', [PortfolioController::class, 'caseStudies']);
Route::get('/case-studies/{slug}', [PortfolioController::class, 'showCaseStudy']);

Route::get('/faqs', [FaqController::class, 'index']);
Route::get('/testimonials', [TestimonialController::class, 'index']);

// Public Appointments & Forms POST
Route::post('/contact', [ContactController::class, 'store']);
Route::post('/newsletter', [NewsletterController::class, 'store']);
Route::post('/appointments', [AppointmentController::class, 'store']); // Public Booking

Route::get('/seo', [CommonController::class, 'pageSeo']);
Route::get('/timeline', [TimelineController::class, 'index']);
Route::get('/journey-timeline', [TimelineController::class, 'index']);
Route::get('/ventures', [VentureController::class, 'index']);
Route::get('/ventures/{slug}', [VentureController::class, 'show']);
Route::get('/now', [NowPageController::class, 'show']);
Route::get('/resources', [CommonController::class, 'resources']);
Route::get('/resources/{id}/download', [ResourceController::class, 'download']);
Route::get('/stats', [CommonController::class, 'stats']);
Route::get('/search', [CommonController::class, 'search']);

// Protected CRUD Actions (Admin Dashboard Panel write APIs)
Route::middleware('auth:sanctum')->group(function () {
    // Blogs CRUD
    Route::post('/blogs/bulk-delete', [BlogController::class, 'bulkDestroy']);
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::put('/blogs/{id}', [BlogController::class, 'update']);
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);

    // Services CRUD
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);

    // Companies CRUD
    Route::post('/companies', [CompanyController::class, 'store']);
    Route::put('/companies/{id}', [CompanyController::class, 'update']);
    Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);

    // Ventures CRUD
    Route::post('/ventures', [VentureController::class, 'store']);
    Route::put('/ventures/{id}', [VentureController::class, 'update']);
    Route::delete('/ventures/{id}', [VentureController::class, 'destroy']);

    // Timeline CRUD
    Route::post('/timeline', [TimelineController::class, 'store']);
    Route::put('/timeline/{id}', [TimelineController::class, 'update']);
    Route::delete('/timeline/{id}', [TimelineController::class, 'destroy']);

    // Now Page Admin CRUD
    Route::put('/admin/now', [NowPageController::class, 'update']);

    // Portfolio CRUD
    Route::post('/portfolio', [PortfolioController::class, 'store']);
    Route::put('/portfolio/{id}', [PortfolioController::class, 'update']);
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy']);

    // FAQs CRUD
    Route::post('/faqs/bulk-delete', [FaqController::class, 'bulkDestroy']);
    Route::post('/faqs', [FaqController::class, 'store']);
    Route::put('/faqs/{id}', [FaqController::class, 'update']);
    Route::delete('/faqs/{id}', [FaqController::class, 'destroy']);

    // Testimonials CRUD
    Route::post('/testimonials', [TestimonialController::class, 'store']);
    Route::put('/testimonials/{id}', [TestimonialController::class, 'update']);
    Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy']);

    // Resources CRUD
    Route::get('/admin/resources', [ResourceController::class, 'index']);
    Route::post('/resources/bulk-delete', [ResourceController::class, 'bulkDestroy']);
    Route::post('/resources', [ResourceController::class, 'store']);
    Route::put('/resources/{id}', [ResourceController::class, 'update']);
    Route::delete('/resources/{id}', [ResourceController::class, 'destroy']);
    Route::post('/admin/upload', [ResourceController::class, 'uploadFile']);
    
    // Appointments CRUD (Admin Management)
    Route::get('/admin/appointments', [AppointmentController::class, 'index']);
    Route::put('/appointments/{id}', [AppointmentController::class, 'update']);
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']);
    
    // CRM leads reading, updating, and deleting
    Route::get('/admin/leads', function() {
        return response()->json([
            'success' => true,
            'data' => \App\Models\ContactRequest::orderBy('created_at', 'desc')->get()
        ]);
    });

    Route::put('/admin/leads/{id}', function(\Illuminate\Http\Request $request, $id) {
        $lead = \App\Models\ContactRequest::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|string',
            'notes' => 'nullable|string'
        ]);
        $lead->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Lead status updated successfully',
            'data' => $lead
        ]);
    });

    Route::delete('/admin/leads/{id}', function($id) {
        $lead = \App\Models\ContactRequest::findOrFail($id);
        $lead->delete();
        return response()->json([
            'success' => true,
            'message' => 'Lead deleted successfully'
        ]);
    });
    
    Route::get('/admin/subscribers', function() {
        return response()->json([
            'success' => true,
            'data' => \App\Models\NewsletterSubscriber::orderBy('created_at', 'desc')->get()
        ]);
    });

    Route::put('/admin/subscribers/{id}', function(\Illuminate\Http\Request $request, $id) {
        $subscriber = \App\Models\NewsletterSubscriber::findOrFail($id);
        $validated = $request->validate([
            'is_active' => 'required|boolean'
        ]);
        $subscriber->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Subscriber status updated successfully',
            'data' => $subscriber
        ]);
    });

    Route::delete('/admin/subscribers/{id}', function($id) {
        $subscriber = \App\Models\NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();
        return response()->json([
            'success' => true,
            'message' => 'Subscriber deleted successfully'
        ]);
    });

    Route::get('/admin/seo', [CommonController::class, 'adminSeoIndex']);
    Route::put('/admin/seo/{id}', [CommonController::class, 'adminSeoUpdate']);

    Route::post('/admin/system/seed', function() {
        try {
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'PriorityBlogsSeeder']);
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'HomepageFaqsSeeder']);
            return response()->json([
                'success' => true,
                'message' => 'System seeders ran successfully! Priority blogs and FAQs have been imported.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to run seeders: ' . $e->getMessage()
            ], 500);
        }
    });

    // Admin Settings Management
    Route::get('/admin/settings', function() {
        $path = storage_path('app/settings.json');
        $defaultSettings = [
            'gsc_verification' => 'google-site-verification-placeholder',
            'bing_verification' => '',
            'ga4_id' => 'G-GFEBQYX1P4',
            'canonical_base' => 'https://www.peshalb.com.np',
            'meta_title' => 'Peshal Bhattarai | Technology Leader & Business Consultant',
            'meta_description' => 'Venture Builder, Digital Transformation Consultant, Agile Coach, Product Strategist, and Technology Executive with over 10 years of enterprise IT leadership experience.',
            'whatsapp_number' => '+9779841517234',
            'telegram_link' => 'https://t.me/+9779841517234',
            'contact_email' => 'peshal@intechnexus.com',
            'contact_phone' => '+977-9841517234',
            'social_linkedin' => 'https://www.linkedin.com/in/peshalbhattarai/',
            'social_twitter' => '',
            'social_medium' => '',
            'social_github' => '',
            'webmail_url' => 'https://saphire.mysecurecloudserver.com:2096/cpsess0670920787/3rdparty/roundcube/?_task=mail&_mbox=INBOX',
            'calendar_public_url' => 'http://mail.peshalb.com.np:2079/calendars/hi@peshalb.com.np/calendar',
            'meeting_link' => 'https://meet.google.com/pb-mock-link',
            'notification_email' => 'hi@peshalb.com.np'
        ];

        if (!file_exists($path)) {
            if (!is_dir(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }
            file_put_contents($path, json_encode($defaultSettings, JSON_PRETTY_PRINT));
        }

        $settings = json_decode(file_get_contents($path), true);
        return response()->json([
            'success' => true,
            'data' => $settings
        ]);
    });

    Route::put('/admin/settings', function(\Illuminate\Http\Request $request) {
        $path = storage_path('app/settings.json');
        
        $validated = $request->validate([
            'gsc_verification' => 'nullable|string',
            'bing_verification' => 'nullable|string',
            'ga4_id' => 'nullable|string',
            'canonical_base' => 'required|url',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            'whatsapp_number' => 'required|string',
            'telegram_link' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'social_linkedin' => 'nullable|string',
            'social_twitter' => 'nullable|string',
            'social_medium' => 'nullable|string',
            'social_github' => 'nullable|string',
            'webmail_url' => 'nullable|string',
            'calendar_public_url' => 'nullable|string',
            'meeting_link' => 'nullable|string',
            'notification_email' => 'nullable|email'
        ]);

        file_put_contents($path, json_encode($validated, JSON_PRETTY_PRINT));

        return response()->json([
            'success' => true,
            'message' => 'Settings saved successfully',
            'data' => $validated
        ]);
    });
});
