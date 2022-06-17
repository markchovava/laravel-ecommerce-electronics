<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSerialNumber extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'serial_number'];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
