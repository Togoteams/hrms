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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('start_amount');
            $table->decimal('end_amount');
            $table->decimal('late_fine_amount');
            $table->string('late_fine_amount_type');
            $table->integer('no_min_installment');
            $table->integer('no_max_installment');
            $table->decimal('max_installment_amount');
            $table->decimal('min_installment_amount');
            $table->integer('rate_of_interest');
            $table->timestamp('deleted_at')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
