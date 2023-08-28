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
        Schema::table('emp_passport_omangs', function (Blueprint $table) {
            // Remove existing columns
            $table->dropColumn('passport_no');
            $table->dropColumn('passport_expiry');
            $table->dropColumn('omang_no');
            $table->dropColumn('omang_expiry');

            // Add new columns
            $table->string('certificate_no')->nullable();
            $table->date('certificate_issue_date')->nullable();
            $table->date('certificate_expiry_date')->nullable();
            $table->string('country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
