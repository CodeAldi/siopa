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
        Schema::create('program_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penanggung_jawab')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('judul');
            $table->string('kategori');
            $table->string('lokasi');
            $table->date('tanggal_kegiatan');
            $table->text('deskrispsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_kerja');
    }
};
