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
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('expenses_currency')->nullable();
            $table->decimal('expenses_amount', 10, 2)->nullable();
            $table->date('claim_date')->nullable();
            $table->string('claim_from_month')->nullable();
            $table->string('claim_to_month')->nullable();
            $table->string('reimbursement_currency')->nullable();
            $table->decimal('reimbursement_amount', 10, 2)->nullable();
            $table->string('reimbursement_notes', 200)->nullable();
            $table->string('reimbursement_reason')->nullable();
            $table->string('status')->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('reimbursement_types');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reimbursements');
    }
};
