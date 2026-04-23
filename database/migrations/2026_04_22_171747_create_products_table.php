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
        Schema::create('produk_dilanf', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk', 100);
            $table->decimal('harga_produk', 10, 0);
            $table->string('foto_produk', 100);
            $table->text('deskripsi_produk');
            $table->integer('stok_produk');
            $table->unsignedBigInteger('kategori_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_dilanf');
    }
};
