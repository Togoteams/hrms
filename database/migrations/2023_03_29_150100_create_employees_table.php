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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->unique();
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('designatin_id');
            $table->string('ec_number');
            $table->string('gender');
            $table->string('id_number');
            $table->string('contract_duration');
            $table->decimal('basic_salary');
            $table->dateTime('date_of_current_basic');
            $table->date('date_of_birth');
            $table->date('start_date');
            $table->unsignedBigInteger('branch_id');
            $table->decimal('pension_contribution');
            $table->string('unique_membership_id');
            $table->string('amount_payable_to_bomaind_each_year');
            $table->string('currency');
            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->string('bank_holder_name');
            $table->string('ifsc');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
