<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $product1 = Product::find(1);
        $product2 = Product::find(5);

        if (!$product1 || !$product2) return;

        // Order 1
        $order1 = Order::create([
            'nama_pembeli' => 'Siti Aminah',
            'email_pembeli' => 'siti@example.com',
            'telepon_pembeli' => '081234567890',
            'alamat_pembeli' => 'Jl. Kebangsaan No. 12, Bandung',
            'total_harga' => $product1->harga_produk * 2,
            'status' => 'completed',
            'created_at' => now()->subDays(5)
        ]);

        OrderItem::create([
            'order_id' => $order1->id_order,
            'product_id' => $product1->id_produk,
            'quantity' => 2,
            'price' => $product1->harga_produk
        ]);

        // Order 2
        $order2 = Order::create([
            'nama_pembeli' => 'Budi Santoso',
            'email_pembeli' => 'budi@example.com',
            'telepon_pembeli' => '085812345678',
            'alamat_pembeli' => 'Perum Permata Indah B-5, Jakarta',
            'total_harga' => $product2->harga_produk * 3,
            'status' => 'pending',
            'created_at' => now()->subHours(10)
        ]);

        OrderItem::create([
            'order_id' => $order2->id_order,
            'product_id' => $product2->id_produk,
            'quantity' => 3,
            'price' => $product2->harga_produk
        ]);
    }
}
