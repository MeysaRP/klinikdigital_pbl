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
        Schema::create('jadwals', function (Blueprint $table) {

            $table->id();

            $table->foreignId('dokter_id')->constrained('dokters');

            $table->string('hari');

            $table->time('jam_mulai');

            $table->time('jam_selesai');

            $table->integer('kuota_pasien');

            $table->enum('status', ['Aktif', 'Nonaktif', 'Cuti'])->default('Aktif');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};