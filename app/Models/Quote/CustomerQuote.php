<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerQuote extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'quote_session', 'ip_address', 'user_id', 'quantity', 
        'usd_subtotal', 'zwl_subtotal', 'tax', 'usd_grandtotal', 
        'zwl_grandtotal'
    ];

    public function customer_quote_items(){
        return $this->hasMany(CustomerQuoteItem::class, 'customer_quote_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
