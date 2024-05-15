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
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
