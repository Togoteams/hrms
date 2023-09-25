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
            $table->bigInteger('transaction_number');
            $table->string('transaction_type')->comment('credit,debit');
            $table->bigInteger('transaction_amount');
            $table->string('transaction_currency');
            $table->bigInteger('user_id')->nullable();
            $table->timestamp('transaction_at');
            $table->bigInteger('refrence_id');
            $table->bigInteger('refrence_table_type');
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
