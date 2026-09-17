<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Extend Ventures Table
        if (Schema::hasTable('ventures')) {
            Schema::table('ventures', function (Blueprint $table) {
                if (!Schema::hasColumn('ventures', 'status')) {
                    $table->string('status')->default('published')->after('category'); // draft, review, published, archived
                }
                if (!Schema::hasColumn('ventures', 'favicon')) {
                    $table->string('favicon')->nullable()->after('logo');
                }
                if (!Schema::hasColumn('ventures', 'cover_image')) {
                    $table->string('cover_image')->nullable()->after('favicon');
                }
                if (!Schema::hasColumn('ventures', 'founded_date')) {
                    $table->string('founded_date')->nullable()->after('cover_image');
                }
                if (!Schema::hasColumn('ventures', 'founder')) {
                    $table->string('founder')->default('Peshal Bhattarai')->after('founded_date');
                }
                if (!Schema::hasColumn('ventures', 'services')) {
                    $table->json('services')->nullable()->after('founder');
                }
                if (!Schema::hasColumn('ventures', 'target_market')) {
                    $table->text('target_market')->nullable()->after('industries');
                }
                if (!Schema::hasColumn('ventures', 'primary_keyword')) {
                    $table->string('primary_keyword')->nullable()->after('target_market');
                }
                if (!Schema::hasColumn('ventures', 'secondary_keywords')) {
                    $table->json('secondary_keywords')->nullable()->after('primary_keyword');
                }
                if (!Schema::hasColumn('ventures', 'seo_title')) {
                    $table->string('seo_title')->nullable()->after('secondary_keywords');
                }
                if (!Schema::hasColumn('ventures', 'meta_description')) {
                    $table->text('meta_description')->nullable()->after('seo_title');
                }
                if (!Schema::hasColumn('ventures', 'canonical_url')) {
                    $table->string('canonical_url')->nullable()->after('meta_description');
                }
                if (!Schema::hasColumn('ventures', 'og_title')) {
                    $table->string('og_title')->nullable()->after('canonical_url');
                }
                if (!Schema::hasColumn('ventures', 'og_description')) {
                    $table->text('og_description')->nullable()->after('og_title');
                }
                if (!Schema::hasColumn('ventures', 'og_image')) {
                    $table->string('og_image')->nullable()->after('og_description');
                }
                if (!Schema::hasColumn('ventures', 'twitter_title')) {
                    $table->string('twitter_title')->nullable()->after('og_image');
                }
                if (!Schema::hasColumn('ventures', 'twitter_description')) {
                    $table->text('twitter_description')->nullable()->after('twitter_title');
                }
                if (!Schema::hasColumn('ventures', 'schema_type')) {
                    $table->string('schema_type')->default('Organization')->after('twitter_description');
                }
                if (!Schema::hasColumn('ventures', 'social_links')) {
                    $table->json('social_links')->nullable()->after('schema_type');
                }
                if (!Schema::hasColumn('ventures', 'contact_information')) {
                    $table->json('contact_information')->nullable()->after('social_links');
                }
                if (!Schema::hasColumn('ventures', 'case_studies')) {
                    $table->json('case_studies')->nullable()->after('contact_information');
                }
                if (!Schema::hasColumn('ventures', 'projects')) {
                    $table->json('projects')->nullable()->after('case_studies');
                }
                if (!Schema::hasColumn('ventures', 'articles')) {
                    $table->json('articles')->nullable()->after('projects');
                }
                if (!Schema::hasColumn('ventures', 'testimonials')) {
                    $table->json('testimonials')->nullable()->after('articles');
                }
                if (!Schema::hasColumn('ventures', 'related_expertise')) {
                    $table->json('related_expertise')->nullable()->after('testimonials');
                }
                if (!Schema::hasColumn('ventures', 'related_ventures')) {
                    $table->json('related_ventures')->nullable()->after('related_expertise');
                }
                if (!Schema::hasColumn('ventures', 'published')) {
                    $table->boolean('published')->default(true)->after('is_active');
                }
            });
        }

        // 2. Landing Pages / Expertise Table
        if (!Schema::hasTable('landing_pages')) {
            Schema::create('landing_pages', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('path')->unique(); // e.g. /business-consulting/nepal/business-registration/
                $table->string('category')->default('business'); // business, dubai, technology, digital_growth
                $table->string('heading')->nullable();
                $table->string('subheading')->nullable();
                $table->text('summary')->nullable();
                $table->longText('content')->nullable();
                $table->string('primary_keyword')->nullable();
                $table->json('secondary_keywords')->nullable();
                $table->string('seo_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('canonical_url')->nullable();
                $table->string('og_title')->nullable();
                $table->text('og_description')->nullable();
                $table->string('og_image')->nullable();
                $table->string('schema_type')->default('Service');
                $table->string('status')->default('draft'); // draft, published
                $table->json('related_ventures')->nullable();
                $table->json('related_case_studies')->nullable();
                $table->json('related_articles')->nullable();
                $table->json('faqs')->nullable();
                $table->boolean('published')->default(false);
                $table->timestamps();
            });
        }

        // 3. Dynamic Site Navigation & Footers
        if (!Schema::hasTable('site_menus')) {
            Schema::create('site_menus', function (Blueprint $table) {
                $table->id();
                $table->string('menu_key')->default('main_nav'); // main_nav, footer_legal, footer_ventures, footer_expertise
                $table->string('label');
                $table->string('url');
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_visible')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_menus');
        Schema::dropIfExists('landing_pages');
    }
};
