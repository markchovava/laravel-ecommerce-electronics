<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
