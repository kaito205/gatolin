<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_dilanf';
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'user_id',
        'nama_pembeli',
        'email_pembeli',
        'telepon_pembeli',
        'alamat_pembeli',
        'total_harga',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id_order');
    }
}
