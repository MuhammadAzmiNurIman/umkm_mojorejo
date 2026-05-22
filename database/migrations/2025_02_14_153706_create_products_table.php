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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('store')->onDelete('cascade'); // Relasi ke store
            $table->string('title'); // Nama produk
            $table->text('description'); // Deskripsi produk
            $table->integer('price'); // Harga produk
            $table->integer('stock'); // Jumlah stok produk
            $table->string('image')->nullable(); // URL gambar produk
            $table->enum('category', ['makanan', 'minuman']); // Kolom kategori dengan tipe data enum
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
