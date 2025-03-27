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
        Schema::create('payroll_ttum_salary_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id');
            $table->bigInteger('branch_id');
            $table->bigInteger('payroll_salary_id');
            $table->bigInteger('payroll_ttum_report_id');
            $table->string('transaction_type')->comment('credit,debit');
            $table->decimal('transaction_amount',10,2);
            $table->string('transaction_currency');
            $table->string('ttum_month');
            $table->string('transaction_details');           
            $table->bigInteger('refrence_id');
            $table->bigInteger('is_13th_cheque_account')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_ttum_salary_reports');
    }
};
