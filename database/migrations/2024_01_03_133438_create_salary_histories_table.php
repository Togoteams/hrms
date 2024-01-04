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
        Schema::create('salary_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('currency_salary')->nullable();
            $table->decimal('basic_salary',10,2)->nullable();
            $table->string('salary_type')->nullable();
            $table->string('da')->nullable();
            $table->decimal('basic_salary_for_india',10,2)->nullable();
            $table->string('currency_salary_for_india')->default('inr');
            $table->date('date_of_current_basic')->nullable();
            $table->string('pension_contribution')->nullable();
            $table->string('pension_opt')->nullable();
            $table->string('status')->nullable()->default("active");
            $table->enum('union_membership_id',["yes","no"])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_histories');
    }
};
