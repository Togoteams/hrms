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
        Schema::create('emp_medical_insurances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->unsignedBigInteger('medical_card_id')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->date('medical_insurances_date')->nullable();
            $table->string('company_name');
            $table->string('insurance_id');
            $table->string('status')->default('active')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('medical_card_id')->references('id')->on('medical_cards');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_medical_insurances');
    }
};
