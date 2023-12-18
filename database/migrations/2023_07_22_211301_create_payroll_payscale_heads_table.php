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
        Schema::create('payroll_payscale_heads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payroll_payscale_id');
            $table->unsignedBigInteger('payroll_head_id');
            $table->double('value',10,2);
            $table->string('status')->default('active');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->foreign('payroll_payscale_id')->references('id')->on('payroll_payscales');
            $table->foreign('payroll_head_id')->references('id')->on('payroll_heads');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_payscale_heads');
    }
};
