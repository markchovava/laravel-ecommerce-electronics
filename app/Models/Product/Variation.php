<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $table = 'variations';

    protected $fillable = [
        'name',
        'value',
        'product_id'
    ];

    public function products()
    {
        return $this->belongsTo(Variation::class, 'product_id', 'id');
    }

    public function brands(){
        return $this->belongsToMany(Brands::class, 'product_variation', 'variation_id', 'brand_id')
            ->withTimestamps();
    }
}
