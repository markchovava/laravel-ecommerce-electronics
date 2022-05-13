<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;


    public function products()
    {
        /* return $this->belongsToMany(Product::class, 'product_variation', 'variation_id', 'product_id')
            ->withTimestamps(); */
        return $this->belongsTo(Variation::class, 'product_id', 'id');
    }
}
