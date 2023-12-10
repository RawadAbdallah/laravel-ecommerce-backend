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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('id_cart_item');
            $table->tinyInteger('quantity');
            $table->decimal('item_total_price', 10, 2);
            $table->unsignedBigInteger('id_cart');
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_cart')->references('id_cart')->on('carts')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
