<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'name',
        'image'
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'product_brands', 'product_id', 'brand_id')
            ->withTimestamps();
    }
}
