<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserProduct;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductMeta;
use App\Models\Product\ProductTag;
use App\Models\Product\ProductBrand;
use App\Models\Product\Tag;
use App\Models\Product\Tax;
use App\Models\Product\Brand;
use App\Models\Product\CategoryProduct;
use App\Models\Product\Discount;
use App\Models\Product\Inventory;
use App\Models\Product\Variation;

class ProductPageController extends Controller
{
    public function view($id){
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        $data['brands'] = Brand::all();
        $data['product_metas'] = ProductMeta::where('product_id', $id)->get();
        $data['product_images'] = ProductImage::where('product_id', $id)->get();
        $data['discounts'] = Discount::where('product_id', $id)->get();
        $data['inventories'] = Inventory::where('product_id', $id)->get();
        $data['taxes'] = Tax::where('product_id', $id)->get();
        $data['variations'] = Variation::where('product_id', $id)->get();
        // Matches with our request id
        $data['product'] = Product::with([
            'categories',
            'brands',
            'product_metas',
            'discounts',
            'inventories',
            'taxes',
            'tags',
            'variations',
            ])->where('id', $id)->first();
        //dd($data['editProduct']->toArray());
        return view('frontend.pages.single', $data);
    }
}
