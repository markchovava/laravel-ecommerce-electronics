<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product\Product;

class Purchase extends Model
{
    use HasFactory;

    public $fillable = [
        'product_id', 'quantity', 'cost','status', 'supplier_id'
    ];

     /*Belong to one */
     public function supplier(){
        return $this->belongsTo(User::class, 'supplier_id', 'id');
    }

     /* One to many */
     public function product(){
        return $this->belongsTo(Product::class, 'supplier_id', 'id');
    }
}
