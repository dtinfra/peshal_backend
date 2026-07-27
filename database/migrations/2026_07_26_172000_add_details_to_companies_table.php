<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->text('story')->nullable();
            $table->text('mission')->nullable();
            $table->json('technologies')->nullable();
            $table->json('industries')->nullable();
            $table->json('faqs')->nullable();
            $table->json('related_services')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['story', 'mission', 'technologies', 'industries', 'faqs', 'related_services']);
        });
    }
};
