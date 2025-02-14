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
        Schema::create('detail_iuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iuran_id')->constrained('iuran')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('anggota_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('bukti_transfer')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_iuran');
    }
};
