<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // buyer
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // produk yang dibeli
            $table->integer('quantity')->default(1); // jumlah barang
            $table->decimal('total_price', 10, 2); // total harga pembelian
            $table->string('status')->default('pending'); // status: pending, paid, delivered, etc
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
