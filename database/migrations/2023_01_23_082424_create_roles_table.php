<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name', 250);
            $table->string('slug', 250)->nullable();
            $table->string('short_code',50)->nullable();
            $table->string('role_type',250)->nullable();
            $table->tinyInteger('is_system_define')->default(0)->nullable();
            $table->text('description')->nullable();
            $table->string('status', 30)->default('active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
