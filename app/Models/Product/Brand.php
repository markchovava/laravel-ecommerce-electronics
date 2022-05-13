<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function variations(){
        return $this->belongsToMany(Variation::class, 'product_variation', 'variation_id', 'brand_id')
            ->withTimestamps();
    }
}
