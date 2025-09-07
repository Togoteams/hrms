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
        Schema::create('leave_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('leave_type_id');
            $table->tinyInteger('is_credit')->default(0)->nullable();
            $table->tinyInteger('is_adjustment')->default(0)->nullable();
            $table->tinyInteger('is_encash')->default(0)->nullable();
            $table->float('leave_count')->nullable()->default(0);
            $table->date('activity_at');
            $table->string('description')->nullable();
            $table->string('leave_update_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_activity_logs');
    }
};
