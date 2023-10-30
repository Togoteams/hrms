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
        Schema::create('payroll_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('status')->default('active');
            $table->string('pay_for_month_year')->nullable();
            $table->double('basic');
            $table->double('total_working_days')->default(0);
            $table->double('no_of_payable_days')->default(0);
            $table->double('annual_balanced_leave')->default(0);
            $table->double('no_availed_leave')->default(0);
            // $table->double('fixed_deductions');
            // $table->double('other_deductions');
            $table->double('net_take_home');
            // $table->double('ctc');
            // $table->double('total_employer_contribution');
            $table->double('total_deduction');
            $table->double('gross_earning');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('payroll_salaries');
    }
};
