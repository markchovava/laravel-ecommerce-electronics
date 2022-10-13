<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerQuoteOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'reference_id', 'currency',
        'subtotal', 'zwl_subtotal', 'include_shipping', 'shipping_fee',
        'total', 'zwl_total', 'status', 'delivery', 'notes'
    ];

    public function customers(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function customer_quote_order_items(){
        return $this->hasMany(CustomerQuoteOrderItem::class, 'customer_quote_order_id', 'id');
    }

}
