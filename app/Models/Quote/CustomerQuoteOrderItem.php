<?php

namespace App\Models\Quote;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerQuoteOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'customer_quote_order_id', 'product_name', 'product_variation', 
        'unit_price', 'zwl_unit_price', 'product_total', 'product_zwl_total',
        'quantity', 'delivery_date'
    ];

    public function customer_quote_order(){
        return $this->belongsTo(CustomerQuoteOrder::class, 'customer_quote_order_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    
}
