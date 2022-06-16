<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'payment_id',
        'total'
    ];

    public function order_items(){
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function payments()
    {
        return $this->belongsTo(PaymentDetail::class, 'order_id', 'id');
    }
}
