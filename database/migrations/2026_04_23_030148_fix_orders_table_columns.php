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
            if (!Schema::hasColumn('order_dilanf', 'nama_pembeli')) {
                $table->string('nama_pembeli')->after('id_order');
            }
            if (!Schema::hasColumn('order_dilanf', 'email_pembeli')) {
                $table->string('email_pembeli')->after('nama_pembeli');
            }
            if (!Schema::hasColumn('order_dilanf', 'telepon_pembeli')) {
                $table->string('telepon_pembeli')->after('email_pembeli');
            }
            if (!Schema::hasColumn('order_dilanf', 'alamat_pembeli')) {
                $table->text('alamat_pembeli')->after('telepon_pembeli');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_dilanf', function (Blueprint $table) {
            $table->dropColumn(['nama_pembeli', 'email_pembeli', 'telepon_pembeli', 'alamat_pembeli']);
        });
    }
};
