<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'SKU',
        'barcode',
        'qrcode',
        'price', 
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')
            ->withTimestamps();
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'product_variation', 'product_id', 'variation_id')
            ->withTimestamps();
    }
}
