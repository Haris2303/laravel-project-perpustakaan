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
        Schema::create('returneds', function (Blueprint $table) {
            $table->id();
            $table->integer('late_payment');
            $table->time('lateness');
            $table->date('return_date');
            $table->date('loan_date');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('borrowing_id');
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('borrowing_id')->references('id')->on('borrowings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returneds');
    }
};
