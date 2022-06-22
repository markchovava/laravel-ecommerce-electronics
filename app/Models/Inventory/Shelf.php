<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;
   
    public $fillable = [
        'product_id', 'quantity', 'status'
    ];
    
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
