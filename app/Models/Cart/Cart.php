<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $fillable = [
        'shopping_session',
        'customer_id',
        'total'
    ];

    public function cart_items(){
            return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
}
