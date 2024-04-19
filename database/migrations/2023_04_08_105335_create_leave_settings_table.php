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
        Schema::create('leave_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('emp_type')->default(1)->comment('1=>local, 0=>ibo');
            $table->double('total_leave_year')->default(0);
            $table->double('max_leave_at_time')->default(0);
            $table->double('extended_leaves_year')->default(0);
            $table->boolean('is_accumulated')->default(0)->comment('1=>yes, 0=>no');
            $table->double('is_accumulated_max_value')->default(0);
            $table->boolean('is_pro_data')->default(0)->comment('1=>yes, 0=>no');
            $table->boolean('is_salary_deduction')->default(0)->comment('1=>yes, 0=>no');
            $table->boolean('salary_deduction_per')->default(0)->comment('1=>yes, 0=>no');
            $table->boolean('extended_leaves_deduction_per')->default(0)->comment('1=>yes, 0=>no');
            $table->boolean('starting_date')->default(0)->comment('1=>DOJ, 0=>Other Date');
            $table->boolean('is_count_holyday')->default(0)->comment('1=>yes, 0=>no');
            $table->boolean('is_leave_encash')->default(0)->comment('1=>yes, 0=>no');
            $table->boolean('is_certificate')->default(0)->comment('1=>yes, 0=>no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_settings');
    }
};
