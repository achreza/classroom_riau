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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_dosen');
            $table->string('nama_tugas');
            $table->string('pertemuan')->nullable();
            $table->date('tanggal_perkuliahan');
            $table->string('file')->nullable();
            $table->string('kode_youtube')->nullable();

            $table->string('deskripsi', 10000);
            $table->date('deadline_date');
            $table->time('deadline_time');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('id_dosen')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};