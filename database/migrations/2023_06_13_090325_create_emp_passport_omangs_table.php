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
            $table->string('type')->nullable();
            $table->string('certificate_no')->nullable();
            $table->date('certificate_issue_date')->nullable();
            $table->date('certificate_expiry_date')->nullable();
            $table->string('country')->nullable();
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
