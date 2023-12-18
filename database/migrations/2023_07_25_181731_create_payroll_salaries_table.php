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
            $table->string('employment_type')->nullable();
            $table->string('status')->default('active');
            $table->string('pay_for_month_year')->nullable();
            $table->double('basic',10,2);
            $table->double('total_working_days')->default(0);
            $table->double('no_of_payable_days')->default(0);
            $table->double('annual_balanced_leave')->default(0);
            $table->double('no_availed_leave')->default(0);
            $table->double('no_of_persent_days')->default(0);
            $table->double('total_loss_of_pay')->default(0);
            $table->double('net_take_home',10,2);
            $table->double('net_take_home_in_pula',10,2)->nullable();
            $table->double('usd_pula_currency_amount',10,2)->nullable();
            $table->double('usd_inr_currency_amount',10,2)->nullable();
            $table->double('pula_inr_currency_amount',10,2)->nullable();
            $table->double('total_deduction',10,2);
            $table->double('gross_earning',10,2);
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
