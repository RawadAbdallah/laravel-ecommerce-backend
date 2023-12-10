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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaction');
            $table->enum('status', ['ordered', 'refunded', 'cancelled']);
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_cart');
            $table->double('order_total_price', 10,2);
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_cart')->references('id_cart')->on('carts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
