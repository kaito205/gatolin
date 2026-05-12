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
        Schema::table('order_dilanf', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable()->after('metode_pembayaran');
            $table->string('status_pembayaran')->default('belum_bayar')->after('bukti_pembayaran'); // belum_bayar, menunggu_verifikasi, lunas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_dilanf', function (Blueprint $table) {
            $table->dropColumn(['bukti_pembayaran', 'status_pembayaran']);
        });
    }
};
