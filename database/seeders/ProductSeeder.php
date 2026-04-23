<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories
        DB::table('kategori_dilanf')->insert([
            ['id_kategori' => 1, 'nama_kategori' => 'Eyeshadow'],
            ['id_kategori' => 2, 'nama_kategori' => 'Face Makeup'],
            ['id_kategori' => 3, 'nama_kategori' => 'Lip Product'],
            ['id_kategori' => 4, 'nama_kategori' => 'Skincare'],
            ['id_kategori' => 5, 'nama_kategori' => 'Accessories'],
        ]);

        // Products
        DB::table('produk_dilanf')->insert([
            [
                'nama_produk' => 'Cushion Glam',
                'harga_produk' => 115000,
                'foto_produk' => 'cushion del glam.jpeg',
                'deskripsi_produk' => 'The secret to flawless skin',
                'stok_produk' => 96,
                'kategori_id' => 2
            ],
            [
                'nama_produk' => 'Liquid Fondation',
                'harga_produk' => 100000,
                'foto_produk' => 'liquid.jpeg',
                'deskripsi_produk' => 'Long-Lasting Beauty!',
                'stok_produk' => 99,
                'kategori_id' => 2
            ],
            [
                'nama_produk' => 'Cocelear Glam',
                'harga_produk' => 85000,
                'foto_produk' => 'concelear.jpeg',
                'deskripsi_produk' => 'Goodbye Dark Circles',
                'stok_produk' => 99,
                'kategori_id' => 2
            ],
            [
                'nama_produk' => 'Skin Tint Glam',
                'harga_produk' => 95000,
                'foto_produk' => 'skin tint.jpeg',
                'deskripsi_produk' => 'Glowing Skin, Perfect Look!',
                'stok_produk' => 100,
                'kategori_id' => 2
            ],
            [
                'nama_produk' => 'The Pinky Glam',
                'harga_produk' => 75000,
                'foto_produk' => 'the classic eye.webp',
                'deskripsi_produk' => 'Flawless Finish, All-Day Glam',
                'stok_produk' => 96,
                'kategori_id' => 1
            ],
            [
                'nama_produk' => 'Lip Oil Glam',
                'harga_produk' => 65000,
                'foto_produk' => 'lipoil.jpeg',
                'deskripsi_produk' => 'Hydrated and Shiny Lips',
                'stok_produk' => 100,
                'kategori_id' => 3
            ],
            [
                'nama_produk' => 'Serum Glowing Premium',
                'harga_produk' => 150000,
                'foto_produk' => 'jenis2.jpg',
                'deskripsi_produk' => 'Serum untuk kulit tampak lebih cerah dan glowing.',
                'stok_produk' => 50,
                'kategori_id' => 4
            ],
            [
                'nama_produk' => 'Gantungan Kunci Teddy Bear',
                'harga_produk' => 25000,
                'foto_produk' => 'ac1.jpg',
                'deskripsi_produk' => 'Gantungan kunci boneka teddy yang sangat lucu.',
                'stok_produk' => 100,
                'kategori_id' => 5
            ],
            [
                'nama_produk' => 'Gantungan Kunci Aesthetic Pink',
                'harga_produk' => 15000,
                'foto_produk' => 'ac2.jpg',
                'deskripsi_produk' => 'Gantungan kunci dengan desain aesthetic berwarna pink.',
                'stok_produk' => 80,
                'kategori_id' => 5
            ],
        ]);
    }
}
