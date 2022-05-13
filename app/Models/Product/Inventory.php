<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'product_option_id', 'quantity']; 

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
