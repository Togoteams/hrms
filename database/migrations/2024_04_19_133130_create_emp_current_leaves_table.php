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
        Schema::create('emp_current_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('employee_type')->nullable();
            $table->integer('leave_type_id')->nullable();          // For Both
            $table->double('leave_count')->nullable();
            $table->double('leave_count_decimal')->nullable();
            $table->double('leave_rounded_value')->default(0)->nullable();
            $table->date('action_date')->nullable();
            $table->string('status')->nullable()->default('active');
            $table->timestamps();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_current_leaves');
    }
};
