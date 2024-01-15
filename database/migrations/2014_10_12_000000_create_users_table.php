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
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('active')->nullable();
            $table->string('unique_key')->nullable();
            $table->timestamp('unique_key_generated_at')->nullable();
            $table->boolean('password_is_changed')->default(0);
            $table->string('image')->nullable();
            $table->string('salutation',100)->nullable();
            $table->string('first_name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->bigInteger('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
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
