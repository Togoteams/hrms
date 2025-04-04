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
        Schema::create('d_b_backups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('date_time')->nullable();
            $table->string('file')->nullable();
            $table->bigInteger('backup_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_b_backups');
    }
};
