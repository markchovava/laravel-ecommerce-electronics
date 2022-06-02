<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = "sales";
    protected $fillable = [
        'product_id',
        'quantity',
        'create_at',
        'updated_at'
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
