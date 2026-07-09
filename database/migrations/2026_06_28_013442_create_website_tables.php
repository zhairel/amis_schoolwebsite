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
        // 1. visitor_logs
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 50)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('page_url', 500)->nullable();
            $table->string('referrer', 500)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->timestamp('visited_at')->useCurrent();
        });

        // 2. daily_stats
        Schema::create('daily_stats', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->integer('total_visits')->default(0);
            $table->integer('unique_visitors')->default(0);
            $table->integer('page_views')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });

        // 3. announcements
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_announcement_id')->nullable();
            $table->string('title');
            $table->text('content');
            $table->string('category', 50)->nullable();
            $table->string('priority', 20)->default('normal');
            $table->text('image')->nullable();
            $table->timestamp('publish_date')->nullable();
            $table->string('author')->nullable();
            $table->timestamps();
        });

        // 4. contact_submissions
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 50)->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('status', 50)->default('new');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('responded_at')->nullable();
        });

        // 5. feedback
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('feedback_type', 50)->nullable();
            $table->integer('rating')->nullable();
            $table->text('message');
            $table->string('status', 50)->default('new');
            $table->timestamp('created_at')->useCurrent();
        });

        // 6. inquiries
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('parent_name');
            $table->string('student_name');
            $table->string('email');
            $table->string('phone', 50);
            $table->string('grade_level', 50)->nullable();
            $table->string('inquiry_type', 50)->nullable();
            $table->text('message')->nullable();
            $table->string('status', 50)->default('pending');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('followed_up_at')->nullable();
        });

        // 7. newsletter_subscribers
        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->timestamp('subscribed_at')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamp('unsubscribed_at')->nullable();
        });

        // 8. settings
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('newsletter_subscribers');
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('feedback');
        Schema::dropIfExists('contact_submissions');
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('daily_stats');
        Schema::dropIfExists('visitor_logs');
    }
};
