<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductSerialNumber;
use App\Models\Inventory\Stock;
use App\Models\Sticker\Sticker;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
        'short_description', 'status',
        'type', 'SKU', 'barcode', 'qrcode',
        'price', 'weight', 'height','width',
        'length'
    ];

    /* Many to Many */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_products', 'product_id', 'user_id')
            ->withTimestamps();
    }

    /* One to many */
    public function serial_numbers(){
        return $this->hasMany(ProductSerialNumber::class, 'product_id', 'id');
    }

    /* Many to Many */
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'product_brands', 'product_id', 'brand_id')
            ->withTimestamps();
    }

    /* Many to Many */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id')
            ->withTimestamps();
    }

    /* Many to Many for Product and Stickers */
    public function stickers(){
        return $this->belongsToMany(Sticker::class, 'product_stickers', 'product_id', 'sticker_id')
            ->withTimestamps();
    }

     /* Many to Many */
     public function tags()
     {
         return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')
             ->withTimestamps();
     }

    public function discounts()
    {
        return $this->hasOne(Discount::class, 'product_id', 'id')
            ->withDefault([
                'name' => 'No Discount'
            ]);
    }

    public function product_metas()
    {
        return $this->hasOne(ProductMeta::class, 'product_id', 'id')
            ->withDefault([
                'title' => 'Write Meta Title', 	
                'description' => 'Write Meta Description',
                'keywords' => 'Write Meta Keywords',
            ]);

    }

    public function inventories()
    {
        return $this->hasOne(Inventory::class, 'product_id', 'id')
            ->withDefault([
                'in_store_quantity' => 'Not in stock',
                'in_warehouse_quantity' => 'Not in stock',
            ]);
    }

    public function taxes()
    {
        return $this->hasOne(Tax::class, 'product_id', 'id')
            ->withDefault([
                'name' => 'No Tax Included'
            ]);
    }

    /* public function variations(){
        return $this->hasMany(Variation::class, 'product_id', 'id')
            ->withDefault([
                'name' => 'Info',
                'value' => 'No variation',
            ]);
    } */

    public function variations(){
        return $this->hasMany(Variation::class, 'product_id', 'id');
    }

    public function product_images(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function sales(){
        return $this->belongsTo(Sales::class, 'product_id', 'id');
    }

    public function stock(){
        return $this->hasOne(Stock::class, 'product_id', 'id');
    }

}
