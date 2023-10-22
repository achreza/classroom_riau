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
        Schema::create('pengumpulan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tugas');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->string('catatan');
            $table->string('file');
            $table->dateTime('pengumpulan');
            $table->string('status')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('id_tugas')->references('id')->on('tugas')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulan');
    }
};