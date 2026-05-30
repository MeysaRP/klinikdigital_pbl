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
        Schema::create('pemesanan_jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('dokter_id')->constrained('dokters');
            $table->foreignId('jadwal_id')->constrained('jadwals');
            $table->string('email');
            $table->string('nama_pasien')->nullable();
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->unsignedInteger('nomor_antrian');
            $table->text('keluhan')->nullable();
            $table->enum('status', ['Menunggu', 'Selesai', 'Dibatalkan'])->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_jadwals');
    }
};
