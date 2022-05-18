<?php

namespace App\Http\Controllers\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product\Category;
use App\Models\Product\CategoryProduct;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductMeta;
use App\Models\Product\ProductTag;
use App\Models\Product\Tag;
use App\Models\Product\Tax;
use App\Models\Product\Discount;
use App\Models\Product\Inventory;



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
            if( $request->file('product_thumbnail') )
            {
                $product_image = $request->file('product_thumbnail');
                $image_extension = strtolower($product_image->getClientOriginalExtension());
                $image_name = date('YmdHi'). '.' . $image_extension;
                $upload_location = 'storage/products/thumbnail/';
                $product_image->move($upload_location, $image_name);
                if($product->image)
                {
                    unlink( $upload_location . $product->image );
                }  
                $product->product_thumbnail = $image_name;      
            }
            $product->product_name = $request->product_name;
            $product->product_description = $request->product_description;
            $product->status = $request->status;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->serialnumber = $request->serialnumber;
            $product->qrcode = $request->qrcode;
            $product->price = $request->price;
            $product->weight = $request->product_weight;
            $product->width = $request->product_width;
            $product->height = $request->product_height;
            $product->length = $request->product_length;
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
            $product_tag = new ProductTag();
            $count_tag = count($request->tag);
            if ($count_tag != NULL) 
            {
                for($i = 0; $i < $count_tag; $i++) 
                {
                    $product_tag->product_id = $product->id;
                    $product_tag->tag_id = $request->category;
                    $product_tag->save();
                }
            }   
            
            /* Product Images */
            $product_images = new ProductImage();
            $count_images = count($request->product_images);
            if ($count_images != NULL) 
            {
                for($i = 0; $i < $count_images; $i++) 
                {
                    $product_images->product_id = $product->id;
                    if( $request->file('product_images') )
                    {
                        $product_images = $request->file('product_images');
                        $image_extension = strtolower($product_images->getClientOriginalExtension());
                        $image_name = date('YmdHi'). '.' . $image_extension;
                        $upload_location = 'storage/products/images/';
                        $product_images->move($upload_location, $image_name);
                        if($product_images->image)
                        {
                            unlink( $upload_location . $product_images->image );
                        }  
                        $product_images->product_thumbnail = $image_name;      
                    }
                    $product_images->save();
                }
            } 

            /* Product Metas */
            $product_meta = new ProductMeta();
            $product_meta->title = $request->meta_title;  
            $product_meta->description = $request->meta_description; 
            $product_meta->keywords = $request->meta_keywords;
            $product_meta->save(); 

            /* Product Discount */
            $product_discount = new Discount();
            $product_discount->name = $request->discount_name;
            $product_discount->discount_percent = $request->discount_percent;
            $product_discount->save();

            /* Product Tax */
            $product_tax = new Tax();
            $product_tax->product_id = $product->id;
            $product_tax->name = $request->tax_name;
            $product_tax->amount_percent = $request->tax_amount_percent;
            $product_tax->save();

            /* Product Inventory */
            $product_inventory = new Inventory();
            $product_inventory->product_id = $product->id;
            $product_inventory->in_store_quantity = $request->in_store_quantity;
            $product_inventory->in_warehouse_quantity = $request->in_warehouse_quantity;
            $product_inventory->save();

            /* Product Variation */
           

        });
    }
}
