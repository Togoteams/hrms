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
        Schema::table('emp_medical_insurances', function (Blueprint $table) {
            $table->unsignedBigInteger('card_id')->nullable();

            $table->foreign('card_id')->references('id')->on('medical_carts');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emp_medical_insurances', function (Blueprint $table) {
            //
        });
    }
};
