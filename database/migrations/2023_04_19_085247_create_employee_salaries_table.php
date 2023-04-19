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
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');
            $table->decimal('basic');
            $table->decimal('hra');
            $table->decimal('overtime');
            $table->decimal('arrear');
            $table->decimal('union_membership');
            $table->integer('pf_per');
            $table->decimal('pf_amount');
            $table->integer('pension_per');
            $table->decimal('pension_amount');
            $table->decimal('loans_deduction');
            $table->integer('no_of_working_days');
            $table->integer('no_of_paid_leaves');
            $table->string('shift');
            $table->string('working_hours_start');
            $table->string('working_hours_end');
            $table->integer('no_of_payable_days');
            $table->decimal('conveyance');
            $table->decimal('special');
            $table->decimal('mobile');
            $table->decimal('bonus');
            $table->decimal('transportation');
            $table->decimal('food');
            $table->decimal('medical');
            $table->decimal('gross_earning');
            $table->integer('esi_per');
            $table->integer('esi_amount');
            $table->decimal('income_tax_deductions');
            $table->decimal('penalty_deductions');
            $table->decimal('fixed_deductions');
            $table->decimal('other_deductions');
            $table->decimal('net_take_home');
            $table->decimal('ctc');
            $table->decimal('total_employer_contribution');
            $table->decimal('total_deduction');
            $table->string('status')->default('active');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salaries');
    }
};
