<?php

namespace App\Models\Cart;

use App\Models\Product\Inventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product\Product;

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

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
