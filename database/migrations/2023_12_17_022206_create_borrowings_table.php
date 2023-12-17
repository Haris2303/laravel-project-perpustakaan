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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->time('lateness');
            $table->date('return_date');
            $table->date('loan_date');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
