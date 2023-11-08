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
        Schema::create('family_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('relation')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('name')->nullable();
            $table->string('depended')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->string('occupations')->nullable();
            $table->string('monthly_income')->nullable();
            $table->string('bank_of_baroda_employee')->nullable();
            $table->text('address_line1')->nullable();
            $table->text('address_line2')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('std_code')->nullable();
            $table->string('number')->nullable();
            $table->string('nationality')->nullable();
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_details');
    }
};
