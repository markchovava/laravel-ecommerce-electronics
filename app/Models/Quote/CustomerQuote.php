<?php

namespace App\Models\Quote;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'usd_cents', 'zwl_cents', 'quantity', 'variation'
    ];
}
