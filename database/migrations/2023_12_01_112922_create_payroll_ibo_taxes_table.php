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
        Schema::create('payroll_ibo_taxes', function (Blueprint $table) {
            $table->id();
            $table->string('financial_year');
            $table->bigInteger('user_id');
            $table->decimal('gross_salary',8,2);
            $table->decimal('reimbursement_amount',8,2);
            $table->decimal('taxable_amount',8,2);
            $table->decimal('tax_amount',8,2);
            $table->timestamp('calculated_at')->nullable();
            $table->bigInteger('calculated_by')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_ibo_taxes');
    }
};
