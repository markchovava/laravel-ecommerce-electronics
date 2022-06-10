<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public $fillable = [
        'product_id',
        'cart_id',
        'quantity',
        'variation_name',
        'variation_value'
    ];

    public function carts(){
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
}
