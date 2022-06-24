<?php

namespace App\Models\Sticker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSticker extends Model
{
    use HasFactory;

    protected $table = 'product_stickers';

    protected $fillable = [
        'product_id',
        'sticker_id',
        'created_at'
    ];
}
