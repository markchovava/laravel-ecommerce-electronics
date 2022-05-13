<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'description', 
        'discount_percent', 
        'start_period', 
        'end_period',
        'status', 
    ]; 
    
    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
