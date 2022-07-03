<?php

namespace App\Models\Product\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product\Product;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'click_name',
        'subtitle',
        'amount',
        'slug',
        'status',
        'image'
    ];


    public function products(){
        return $this->belongsToMany(Product::class, 'product_tags', 'tag_id', 'product_id')
            ->withTimestamps();
    }

}
