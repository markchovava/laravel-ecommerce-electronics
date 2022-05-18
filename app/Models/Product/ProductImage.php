<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = "product_images";

    public function products()
    {
        return $this->belongsTo(ProductImage::class, 'product_id', 'id');
    }
}
