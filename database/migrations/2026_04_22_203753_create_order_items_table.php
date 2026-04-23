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
        Schema::create('order_items_dilanf', function (Blueprint $table) {
            $table->id('id_item');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('price', 12, 0);
            $table->timestamps();

            $table->foreign('order_id')->references('id_order')->on('order_dilanf')->onDelete('cascade');
            $table->foreign('product_id')->references('id_produk')->on('produk_dilanf')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items_dilanf');
    }
};
