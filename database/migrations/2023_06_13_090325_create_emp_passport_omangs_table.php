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
        Schema::create('emp_passport_omangs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('passport_no')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->string('omang_no')->nullable();
            $table->date('omang_expiry')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_passport_omangs');
    }
};
