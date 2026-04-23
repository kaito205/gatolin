<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items_dilanf';
    protected $primaryKey = 'id_item';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id_produk');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id_order');
    }
}
