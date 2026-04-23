<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'kategori_dilanf';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;
    protected $fillable = ['nama_kategori'];

    public function products()
    {
        return $this->hasMany(Product::class, 'kategori_id', 'id_kategori');
    }
}
