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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->integer('duration_minutes')->default(30);
            $table->string('meeting_link')->nullable();
            $table->string('status')->default('pending'); // pending, confirmed, cancelled, completed
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('service_id')
                  ->references('id')
                  ->on('services')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
