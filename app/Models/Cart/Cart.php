<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product\Product;

class Cart extends Model
{
    use HasFactory;

    public $fillable = [
        'shopping_session',
        'ip_address',
        'customer_id',
        'total'
    ];
 
    public function products(){
            return $this->belongsToMany(Product::class, 'cart_items', 'cart_id', 'product_id')
                ->withTimestamps();
    }

    public function cart_items(){
            return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    
}
