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
        Schema::create('current_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('employee_type')->nullable();
            $table->integer('sick_leave')->nullable();          // For Both
            $table->integer('earned_leave')->nullable();        // For Local
            $table->integer('maternity_leave')->nullable();     // For Both
            $table->integer('bereavement_leave')->nullable();   // For Local
            $table->integer('leave_without_pay')->nullable();   // For Both
            $table->integer('casual_leave')->nullable();        // For IBO
            $table->integer('privileged_leave')->nullable();    // For IBO
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_leaves');
    }
};
