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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('mobile')->nullable();   
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('active')->nullable();
            // $table->bigInteger('department_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            // $table->bigInteger('created_by')->nullable();
            // $table->foreignId('created_by')->references('id')->on('users')->nullable()->comment('used for created by user tracking');
            // $table->foreignId('updated_by')->references('id')->on('users')->nullable()->comment('used for updated by user tracking');
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
