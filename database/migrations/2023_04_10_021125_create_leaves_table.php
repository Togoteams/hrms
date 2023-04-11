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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('leave_applies_for');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('is_approved')->default(0);
            $table->string('approved_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->string('is_paid')->default(0);
            $table->string('leave_reason');
            $table->date('apply_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('remark')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
