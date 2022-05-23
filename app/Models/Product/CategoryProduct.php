<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    
    protected $table = 'category_product';

    protected $fillable = [
        'product_id',
        'category_id',
        'created_at'
    ];
}
