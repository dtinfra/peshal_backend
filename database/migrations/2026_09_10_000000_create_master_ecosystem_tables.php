<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Ventures Table
        if (!Schema::hasTable('ventures')) {
            Schema::create('ventures', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('tagline')->nullable();
                $table->string('category')->default('technology'); // technology, digital_growth, travel, real_estate
                $table->string('logo')->nullable();
                $table->text('description')->nullable();
                $table->longText('content')->nullable();
                $table->string('website_url')->nullable();
                $table->string('my_role')->nullable();
                $table->json('locations')->nullable();
                $table->json('technologies')->nullable();
                $table->json('industries')->nullable();
                $table->json('faqs')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_featured')->default(true);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 2. Journey Timeline Events Table
        if (!Schema::hasTable('timeline_events')) {
            Schema::create('timeline_events', function (Blueprint $table) {
                $table->id();
                $table->string('year');
                $table->string('title');
                $table->string('category')->default('milestone'); // education, technology, product, venture, travel, dubai, current
                $table->text('description')->nullable();
                $table->longText('content')->nullable();
                $table->string('image_url')->nullable();
                $table->string('evidence_url')->nullable();
                $table->unsignedBigInteger('venture_id')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_published')->default(true);
                $table->timestamps();
            });
        }

        // 3. Now Page Settings Table
        if (!Schema::hasTable('now_page_settings')) {
            Schema::create('now_page_settings', function (Blueprint $table) {
                $table->id();
                $table->json('building')->nullable();
                $table->json('exploring')->nullable();
                $table->json('learning')->nullable();
                $table->json('reading')->nullable();
                $table->text('current_focus')->nullable();
                $table->timestamp('last_updated_at')->nullable();
                $table->timestamps();
            });
        }

        // 4. Extend Contact Requests for Lead Qualification & Routing
        if (Schema::hasTable('contact_requests')) {
            Schema::table('contact_requests', function (Blueprint $table) {
                if (!Schema::hasColumn('contact_requests', 'phone_whatsapp')) {
                    $table->string('phone_whatsapp')->nullable()->after('phone');
                }
                if (!Schema::hasColumn('contact_requests', 'country')) {
                    $table->string('country')->nullable()->after('company');
                }
                if (!Schema::hasColumn('contact_requests', 'website')) {
                    $table->string('website')->nullable()->after('country');
                }
                if (!Schema::hasColumn('contact_requests', 'industry')) {
                    $table->string('industry')->nullable()->after('website');
                }
                if (!Schema::hasColumn('contact_requests', 'lead_category')) {
                    $table->string('lead_category')->default('other')->after('industry');
                }
                if (!Schema::hasColumn('contact_requests', 'budget_range')) {
                    $table->string('budget_range')->nullable()->after('lead_category');
                }
                if (!Schema::hasColumn('contact_requests', 'timeline')) {
                    $table->string('timeline')->nullable()->after('budget_range');
                }
                if (!Schema::hasColumn('contact_requests', 'routed_to')) {
                    $table->string('routed_to')->default('peshal_team')->after('timeline');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('now_page_settings');
        Schema::dropIfExists('timeline_events');
        Schema::dropIfExists('ventures');
    }
};
