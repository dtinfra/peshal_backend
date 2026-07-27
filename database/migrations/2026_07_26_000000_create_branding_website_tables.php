<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. SEO Metadata
        Schema::create('seo_metadata', function (Blueprint $table) {
            $table->id();
            $table->string('model_type')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_card')->default('summary_large_image');
            $table->json('json_ld')->nullable();
            $table->timestamps();

            $table->index(['model_type', 'model_id']);
        });

        // 2. Blog Authors
        Schema::create('blog_authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('designation')->nullable();
            $table->string('email')->nullable();
            $table->json('social_links')->nullable();
            $table->timestamps();
        });

        // 3. Blog Categories
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 4. Blogs
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->integer('reading_time')->default(0);
            $table->foreignId('author_id')->constrained('blog_authors')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('blog_categories')->onDelete('cascade');
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // 5. Blog Tags
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 6. Blog Tag Post Pivot
        Schema::create('blog_tag_post', function (Blueprint $table) {
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('blog_tags')->onDelete('cascade');
            $table->primary(['blog_id', 'tag_id']);
        });

        // 7. Services
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 8. Companies / Ventures
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('website_url')->nullable();
            $table->json('services')->nullable(); // Digital marketing, IoT services, etc.
            $table->json('locations')->nullable(); // USA, Australia, Switzerland, Dubai, etc.
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 9. Testimonials
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_image')->nullable();
            $table->string('company_name')->nullable();
            $table->string('position')->nullable();
            $table->tinyInteger('rating')->default(5);
            $table->text('review');
            $table->string('video_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('country')->nullable();
            $table->timestamps();
        });

        // 10. Portfolio Projects
        Schema::create('portfolio_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client_name')->nullable();
            $table->text('summary')->nullable();
            $table->text('content')->nullable();
            $table->string('main_image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('technologies')->nullable();
            $table->json('business_outcomes')->nullable();
            $table->string('results_summary')->nullable();
            $table->string('website_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 11. Case Studies
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_project_id')->nullable()->constrained('portfolio_projects')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('problem');
            $table->text('solution');
            $table->json('technology')->nullable();
            $table->text('approach')->nullable();
            $table->string('timeline_duration')->nullable();
            $table->text('challenges')->nullable();
            $table->text('results')->nullable();
            $table->decimal('roi_percentage', 5, 2)->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 12. FAQs
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->string('category_key'); // homepage, seo, agile, scrum, etc.
            $table->string('page_slug')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 13. Media Items
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('file_path');
            $table->string('file_type'); // image, pdf, video, etc.
            $table->unsignedInteger('file_size');
            $table->string('mime_type');
            $table->timestamps();
        });

        // 14. Team Members
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->json('social_links')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 15. Job Listings
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('department')->nullable();
            $table->string('location')->nullable();
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->string('salary_range')->nullable();
            $table->string('type')->default('Full-time'); // Full-time, Remote, Contract, etc.
            $table->string('status')->default('active'); // active, closed
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        // 16. Job Applications
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained('job_listings')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('resume_path');
            $table->text('cover_letter')->nullable();
            $table->string('status')->default('pending'); // pending, reviewed, rejected, accepted
            $table->timestamps();
        });

        // 17. Contact Requests / Consultation Bookings
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->text('message')->nullable();
            $table->string('service_requested')->nullable();
            $table->timestamp('appointment_time')->nullable();
            $table->string('status')->default('pending'); // pending, contact, booked, completed
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 18. Newsletter Subscribers
        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 19. Downloads / Whitepapers / Resources
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->default('Whitepaper'); // Whitepaper, Guide, Report, Checklists
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('cover_image')->nullable();
            $table->unsignedInteger('download_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 20. Events
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->default('Speaking'); // Speaking, Mentoring, Webinar, Workshop
            $table->text('description')->nullable();
            $table->date('event_date');
            $table->string('location')->nullable();
            $table->string('link')->nullable();
            $table->boolean('is_speaking')->default(true);
            $table->timestamps();
        });

        // 21. Awards
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('organization');
            $table->integer('year');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // 22. Certifications
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('organization');
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('credential_id')->nullable();
            $table->string('credential_url')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        // 23. Podcasts
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('duration')->nullable();
            $table->string('spotify_url')->nullable();
            $table->string('apple_podcast_url')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // 24. Videos
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('youtube_url');
            $table->string('duration')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // 25. Audit Logs
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action');
            $table->text('description')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->json('payload')->nullable();
            $table->timestamps();
        });

        // 26. Redirect Manager
        Schema::create('redirect_rules', function (Blueprint $table) {
            $table->id();
            $table->string('source_path')->unique();
            $table->string('target_path');
            $table->integer('status_code')->default(301);
            $table->timestamps();
        });

        // 27. 404 Error Log Manager
        Schema::create('error_logs', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('referer')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });

        // 28. Work Experiences
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('logo')->nullable();
            $table->string('role');
            $table->string('location')->nullable();
            $table->string('type')->nullable(); // Full-time, Part-time, Contract, etc.
            $table->string('duration_text')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->json('skills')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // 29. Education Records
        Schema::create('education_records', function (Blueprint $table) {
            $table->id();
            $table->string('institution_name');
            $table->string('logo')->nullable();
            $table->string('degree');
            $table->string('study_field')->nullable();
            $table->string('grade')->nullable();
            $table->string('duration_text')->nullable();
            $table->integer('start_year')->nullable();
            $table->integer('end_year')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_records');
        Schema::dropIfExists('work_experiences');
        Schema::dropIfExists('error_logs');
        Schema::dropIfExists('redirect_rules');
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('podcasts');
        Schema::dropIfExists('certifications');
        Schema::dropIfExists('awards');
        Schema::dropIfExists('events');
        Schema::dropIfExists('resources');
        Schema::dropIfExists('newsletter_subscribers');
        Schema::dropIfExists('contact_requests');
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('job_listings');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('media_items');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('case_studies');
        Schema::dropIfExists('portfolio_projects');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('services');
        Schema::dropIfExists('blog_tag_post');
        Schema::dropIfExists('blog_tags');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('blog_authors');
        Schema::dropIfExists('seo_metadata');
    }
};
