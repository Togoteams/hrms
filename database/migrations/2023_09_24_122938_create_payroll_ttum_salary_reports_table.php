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
            $table->string('transaction_type')->comment('credit,debit');
            $table->decimal('transaction_amount',10,3);
            $table->string('transaction_currency');
            $table->string('ttum_month');
            $table->string('transaction_details');           
            $table->bigInteger('refrence_id');
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
