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
        Schema::create('emp_payscales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->decimal('basic');
            $table->decimal('hra');
            $table->decimal('overtime');
            $table->decimal('arrear');
            $table->bigInteger('union_membership');
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
            $table->decimal('esi_amount');
            $table->decimal('income_tax_deductions');
            $table->decimal('penalty_deductions');
            $table->decimal('fixed_deductions');
            $table->decimal('other_deductions');
            $table->decimal('net_take_home');
            $table->decimal('total_deduction');
            $table->decimal('ctc');
            $table->decimal('total_employer_contribution');
            $table->bigInteger('created_by');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_payscales');
    }
};
