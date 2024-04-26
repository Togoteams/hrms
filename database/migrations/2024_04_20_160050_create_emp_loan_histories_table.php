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
        Schema::create('emp_loan_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('loan_types');
            $table->string('loan_account_no');
            $table->string('account_id');
            $table->double('loan_amount');
            $table->double('emi_amount');
            $table->date('emi_start_date')->nullable();
            $table->date('emi_end_date')->nullable();
            // $table->integer('tenure');
            // $table->string('last_emi_amount');
            $table->string('description')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('status')->default('active')->comment('active,completed,in-progress');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_loan_histories');
    }
};
