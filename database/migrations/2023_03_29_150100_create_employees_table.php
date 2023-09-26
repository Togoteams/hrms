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
            $table->unsignedBigInteger('designation_id')->nullable();
            // $table->unsignedBigInteger('tax_id')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('ec_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('id_number')->nullable();
            $table->string('contract_duration')->nullable();
            $table->decimal('basic_salary')->nullable();
            $table->dateTime('date_of_current_basic')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('birth_country',100)->nullable();
            $table->string('blood_group',100)->nullable();
            $table->string('place_of_domicile')->nullable();
            $table->date('start_date')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('pension_contribution')->nullable();
            $table->string('pension_opt')->nullable();
            $table->enum('union_membership_id',["yes","no"])->nullable();            
            $table->string('amount_payable_to_bomaind_each_year')->nullable();
            $table->string('currency')->nullable();
            $table->string('bank_account_number')->nullable();
            // $table->string('bank_name');
            // $table->string('bank_holder_name');
            // $table->string('ifsc');
            $table->string('status')->default('active');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('designation_id')->references('id')->on('designations');
            // $table->foreign('branch_id')->references('id')->on('branches');
            // $table->foreign('tax_id')->references('id')->on('taxes');

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
