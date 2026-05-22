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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('store_id')->constrained('store')->onDelete('cascade'); // Fix: stores bukan store
            $table->text('order_details'); // Detail pesanan dalam format JSON
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'paid', 'failed', 'expired'])->default('pending'); // Fix: Sesuai dengan Midtrans
            $table->string('order_id')->unique(); // Fix: Tambahkan kolom order_id dari Midtrans
            $table->string('snap_token')->nullable(); // Fix: Tambahkan snap_token dari Midtrans
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
