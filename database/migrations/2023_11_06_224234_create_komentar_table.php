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
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tugas');
            $table->unsignedBigInteger('id_user');
            $table->text('komentar');

            $table->foreign('id_tugas')->references('id')->on('tugas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
