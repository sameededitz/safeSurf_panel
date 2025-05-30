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
        Schema::create('user_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('token_id')->nullable()->constrained('personal_access_tokens')->nullOnDelete();
            $table->string('device_id')->nullable()->unique(); // Unique identifier for the device, e.g., UUID
            $table->string('device_name'); // e.g., iPhone 14, Chrome on Mac
            $table->string('device_type'); // mobile / web / desktop
            $table->string('platform')->nullable(); // iOS / Android / Windows / macOS etc.
            $table->string('ip_address')->nullable();
            $table->timestamp('last_active_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_devices');
    }
};
