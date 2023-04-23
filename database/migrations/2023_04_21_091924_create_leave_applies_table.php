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
        Schema::create('leave_applies', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('leave_type_id');
            $table->unsignedBigInteger('user_id');
            $table->string('leave_applies_for');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('is_approved')->default(0);
            $table->string('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('is_paid')->default(0);
            $table->string('leave_reason');
            $table->date('apply_date')->nullable();
            $table->string('remark')->nullable();
            $table->string('status')->default('pending');
            $table->string('doc');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('leave_type_id')->references('id')->on('leave_types');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_applies');
    }
};
