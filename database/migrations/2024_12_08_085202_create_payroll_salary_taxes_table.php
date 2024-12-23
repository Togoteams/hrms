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
        Schema::create('payroll_salary_taxes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('employee_type')->nullable();
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('payroll_id')->nullable();
            $table->bigInteger('month')->nullable();
            $table->bigInteger('year')->nullable();
            $table->decimal('gross_earning_amount',12,4)->nullable();
            $table->decimal('taxable_amount',12,4)->nullable();
            $table->decimal('tax_amount',12,4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_salary_taxes');
    }
};
