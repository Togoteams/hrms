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
        Schema::create('leave_dates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('leave_id');
            $table->date('leave_date');
            $table->tinyInteger('is_holiday')->nullable()->default('0');
            $table->string('pay_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_dates');
    }
};
