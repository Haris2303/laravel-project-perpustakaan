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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 16);
            $table->string('title', 200);
            $table->text('description');
            $table->year('publication_year');
            $table->integer('quantity');
            $table->string('author', 100);
            $table->string('publisher', 100);
            $table->char('shell_code', 4);
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
