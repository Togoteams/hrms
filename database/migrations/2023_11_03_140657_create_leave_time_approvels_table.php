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
        
        Schema::create('leave_time_approvels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('leave_type_id')->nullable();
            $table->unsignedBigInteger('approval_authority')->nullable();
            $table->string('request_date',)->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('document')->nullable();
            $table->string('reason')->nullable();
            $table->text('description',)->nullable();
            $table->string('description_reason')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('leave_type_id')->references('id')->on('leave_settings');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave-time-approvels');
    }
};
