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
    Schema::create('antrians', function (Blueprint $table) {
        $table->id();

        $table->foreignId('pemesanan_id')
              ->constrained('pemesanan_jadwals')
              ->onDelete('cascade');

        $table->string('nomor_antrian');

        $table->enum('status', [
            'menunggu',
            'dipanggil',
            'selesai'
        ])->default('menunggu');

        $table->timestamp('waktu_panggil')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
