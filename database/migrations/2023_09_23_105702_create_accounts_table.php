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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number')->nullable();
            $table->bigInteger('branch_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('account_type')->nullable();
            $table->string('is_credit')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->enum('status',["active","inactive"])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
