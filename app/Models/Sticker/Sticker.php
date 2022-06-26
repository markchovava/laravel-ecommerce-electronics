<?php

namespace App\Models\Sticker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_stickers', 'sticker_id', 'product_id')
            ->withTimestamps();
    }

}
