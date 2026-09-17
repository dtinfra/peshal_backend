<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('landing_pages')) {
            Schema::table('landing_pages', function (Blueprint $table) {
                if (!Schema::hasColumn('landing_pages', 'search_intent')) {
                    $table->string('search_intent')->nullable()->after('primary_keyword');
                }
                if (!Schema::hasColumn('landing_pages', 'target_location')) {
                    $table->string('target_location')->nullable()->after('search_intent');
                }
                if (!Schema::hasColumn('landing_pages', 'parent_topic')) {
                    $table->string('parent_topic')->nullable()->after('target_location');
                }
                if (!Schema::hasColumn('landing_pages', 'internal_links')) {
                    $table->json('internal_links')->nullable()->after('related_articles');
                }
                if (!Schema::hasColumn('landing_pages', 'sections')) {
                    $table->json('sections')->nullable()->after('internal_links');
                }
                if (!Schema::hasColumn('landing_pages', 'redirect_url')) {
                    $table->string('redirect_url')->nullable()->after('sections');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('landing_pages')) {
            Schema::table('landing_pages', function (Blueprint $table) {
                $table->dropColumn([
                    'search_intent',
                    'target_location',
                    'parent_topic',
                    'internal_links',
                    'sections',
                    'redirect_url'
                ]);
            });
        }
    }
};
