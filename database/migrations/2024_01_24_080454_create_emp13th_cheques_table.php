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
        Schema::create('emp13th_cheques', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('branch_id');
            $table->date('salary_date_pay_for')->nullable();
            $table->string('financial_year')->nullable();
            $table->string('cheque_id')->nullable();
            $table->double('jan_salary')->default('0')->nullable();
            $table->double('feb_salary')->default('0')->nullable();
            $table->double('march_salary')->default('0')->nullable();
            $table->double('april_salary')->default('0')->nullable();
            $table->double('may_salary')->default('0')->nullable();
            $table->double('june_salary')->default('0')->nullable();
            $table->double('july_salary')->default('0')->nullable();
            $table->double('aug_salary')->default('0')->nullable();
            $table->double('sep_salary')->default('0')->nullable();
            $table->double('oct_salary')->default('0')->nullable();
            $table->double('nov_salary')->default('0')->nullable();
            $table->double('dec_salary')->default('0')->nullable();
            $table->double('total_amount')->default('0')->nullable();
            $table->double('average_amount')->default('0')->nullable();
            $table->double('total_i_tax_amount')->default('0')->nullable();
            $table->double('net_payable_amount')->default('0')->nullable();
            $table->string('currency')->default('pula')->nullable();
            $table->string('status')->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp13th_cheques');
    }
};
