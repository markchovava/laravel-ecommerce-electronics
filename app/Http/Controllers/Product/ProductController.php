<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use App\Models\Product\CategoryProduct;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductTag;
use App\Models\Product\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::with('categories')->get();
        return view('backend.products.index', $data);
    }

    public function add()
    {
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        return view('backend.products.add', $data);
    }

    public function store(Request $request)
    {
        DB::transaction(function() use($request){

            /* Product */
            $product = new Product();
            $product->name = $request->product_name;
            $product->description = $request->product_description;
            $product->sku = $request->sku;
            $product->barcode = $request->product_name;
            $product->serialnumber = $request->serialnumber;
            $product->qrcode = $request->qrcode;
            $product->price = $request->price;
            $product->save();
            
            /* Category Products */
            $category_product = new CategoryProduct();
            $count_category = count($request->category);
            if ($count_category != NULL) 
            {
                for($i = 0; $i < $count_category; $i++) 
                {
                    $category_product->product_id = $product->id;
                    $category_product->category_id = $request->category;
                    $category_product->save();
                }
            }   
           
            /* Tags */
            $tag = new Tag();
            $tag = new ProductTag();
            $count_tag = count($request->tag);
            if ($count_tag != NULL) 
            {
                for($i = 0; $i < $count_tag; $i++) 
                {
                    $tag->product_id = $product->id;
                    $tag->tag_id = $request->category;
                    $tag->save();
                }
            }   
            
            /* Product Images */
            $product_image = new ProductImage();
            $count_images = count($request->product_images);
            if ($count_tag != NULL) 
            {
                for($i = 0; $i < $count_tag; $i++) 
                {
                    $product_image->product_id = $product->id;
                    $product_image->category_id = $request->category;
                    $tag->save();
                }
            }   

        });
    }
}
