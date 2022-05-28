<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',	
        'amount',
        'provider',	
        'method',	
        'status'
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'payment_id', 'id');
    }
}
