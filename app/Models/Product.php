<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'produk_dilanf';
    protected $primaryKey = 'id_produk';
    public $timestamps = false; // Legacy table doesn't have timestamps

    protected $fillable = [
        'nama_produk',
        'harga_produk',
        'foto_produk',
        'video_produk',
        'deskripsi_produk',
        'stok_produk',
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}
