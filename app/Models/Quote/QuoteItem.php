<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'quote_id',
        'product_name',
        'description',
        'quantity',
        'price_cents',
        'zw_price_cents',
        'total_cents',
        'zw_total_cents'
    ];

    public function products(){
        return $this->belongsTo(QuoteItem::class, 'quote_id', 'id');
    }
}
