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
        Schema::create('store', function (Blueprint $table) {
            $table->id(); // Kolom ID (Primary Key)
            $table->string('nama_toko'); // Nama toko
            $table->time('jam_buka'); // Jam buka toko
            $table->time('jam_tutup'); // Jam tutup toko
            $table->string('phone_number'); // Nomor HP toko untuk menerima pesanan
            $table->string('logo_toko')->nullable(); // URL logo toko (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store');
    }
};
