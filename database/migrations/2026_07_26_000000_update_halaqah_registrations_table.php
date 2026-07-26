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
        Schema::table('halaqah_registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('halaqah_registrations', 'age')) {
                $table->integer('age')->nullable()->after('name');
            }
            if (!Schema::hasColumn('halaqah_registrations', 'sex')) {
                $table->string('sex', 20)->nullable()->after('age');
            }
            if (!Schema::hasColumn('halaqah_registrations', 'status')) {
                $table->string('status', 50)->nullable()->after('sex');
            }
            if (!Schema::hasColumn('halaqah_registrations', 'fb_account')) {
                $table->string('fb_account')->nullable()->after('level');
            }
            if (!Schema::hasColumn('halaqah_registrations', 'mobile')) {
                $table->string('mobile', 50)->nullable()->after('fb_account');
            }
            if (!Schema::hasColumn('halaqah_registrations', 'type')) {
                $table->string('type', 100)->nullable()->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('halaqah_registrations', function (Blueprint $table) {
            $table->dropColumn(['age', 'sex', 'status', 'fb_account', 'mobile', 'type']);
        });
    }
};
