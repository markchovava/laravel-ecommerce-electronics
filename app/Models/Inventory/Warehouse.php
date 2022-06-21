<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product\Product;

class Warehouse extends Model
{
    use HasFactory;

    public $fillable = [
        'product_id', 'quantity', 'status'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
