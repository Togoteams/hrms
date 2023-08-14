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
        Schema::create('tax_slab_settings', function (Blueprint $table) {
            $table->id();
            $table->double('from');
            $table->double('to');
            $table->double('ibo_tax_per');
            $table->double('local_tax_per');
            $table->double('additional_ibo_amount');
            $table->double('additional_local_amount');
            $table->text('description');
            $table->string('status')->default('active');
            $table->foreignId('created_by')->references('id')->on('users');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users');
            $table->foreignId('deleted_by')->nullable()->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_slab_settings');
    }
};
