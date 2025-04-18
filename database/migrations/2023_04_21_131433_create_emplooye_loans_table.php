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
        Schema::create('emplooye_loans', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('loan_types');
            $table->string('loan_account_no');
            $table->string('loan_amount');
            $table->string('emi_amount');
            $table->date('emi_start_date');
            $table->date('emi_end_date');
            // $table->integer('tenure');
            // $table->string('last_emi_amount');
            $table->string('description')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('status')->default('active')->comment('active,completed,in-progress');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emplooye_loans');
    }
};
