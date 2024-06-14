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
        Schema::create('payroll_payscales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('status')->default('active');
            $table->double('basic',8,3);
            $table->date('payscale_date')->nullable();
            // $table->double('fixed_deductions');
            // $table->double('other_deductions');
            $table->double('net_take_home');
            // $table->double('ctc');
            // $table->double('total_employer_contribution');
            $table->double('total_deduction',8,3);
            $table->double('gross_earning',8,3);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreignId('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_roll_payscales');
    }
};
