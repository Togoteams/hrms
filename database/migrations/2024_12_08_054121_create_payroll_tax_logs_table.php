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
        Schema::create('payroll_tax_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->tinyInteger('tax_type')->default(0)->comment('1->Salary, 2 -> reimbursement')->nullable();
            $table->bigInteger('payroll_salary_tax_id')->nullable();
            $table->decimal('tax_amount',12,4)->nullable();
            $table->string('head_name')->nullable();
            $table->decimal('head_value',12,4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_tax_logs');
    }
};
