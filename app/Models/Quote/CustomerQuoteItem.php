<?php

namespace App\Models\Quote;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerQuoteItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'customer_quote_id', 'product_id', 'product_name', 'usd_cents', 
        'zwl_cents', 'quantity', 'variation'
    ];

    public function customer_quote(){
        return $this->belongsTo(CustomerQuote::class, 'customer_quote_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
 