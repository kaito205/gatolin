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
        Schema::create('order_dilanf', function (Blueprint $table) {
            $table->id('id_order');
            $table->string('nama_pembeli');
            $table->string('email_pembeli');
            $table->string('telepon_pembeli');
            $table->text('alamat_pembeli');
            $table->decimal('total_harga', 12, 0);
            $table->string('status', 50)->default('pending'); // pending, processing, shipped, completed, cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_dilanf');
    }
};
