<?php

namespace App\Http\Controllers\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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


class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::with(['categories','brands','tags', 'users'])->orderBy('updated_at','desc')->get();
        //return $data['products'];
        return view('backend.products.index', $data);
    }

    public function add()
    {
        $data['categories'] = Category::all();
        $data['brands'] = Brand::all();
        $data['tags'] = Tag::all();
        return view('backend.products.add', $data);
    }

    public function store(Request $request){
        DB::transaction(function() use($request){

            /* Product */
            $product = new Product();
            if( $request->file('product_thumbnail') )
            {
                $product_thumbnail = $request->file('product_thumbnail');
                $image_extension = strtolower($product_thumbnail->getClientOriginalExtension());
                $image_name = date('YmdHi'). '.' . $image_extension;
                $upload_location = 'storage/products/thumbnail/';
                if($product->image){
                    unlink($upload_location . $product->image);
                    $product_thumbnail->move($upload_location, $image_name);
                    $product->image = $image_name;                    
                }else{
                    $product_thumbnail->move($upload_location, $image_name);
                    $product->product_thumbnail = $image_name;
                }              
            }
            $product->name = $request->product_name;
            $product->description = $request->product_description;
            $product->short_description = $request->product_short_description;
            $product->type = $request->product_type;
            $product->status = $request->product_status;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->serialnumber = $request->serialnumber;
            $product->qrcode = $request->qrcode;
            $product->price = $request->product_price;
            $product->zwl_price = $request->zwl_product_price;
            $product->physical_delivery = $request->physical_delivery;
            $product->weight = $request->product_weight;
            $product->width = $request->product_width;
            $product->height = $request->product_height;
            $product->length = $request->product_length;
            $product->save();

            /* User Product */
            $user_product = new UserProduct();
            $user_product->user_id = Auth::user()->id;
            $user_product->product_id = $product->id;
            $user_product->save();
            
            /* Category Products */
            $categories = $request->category__repeaterBasic;  // Is generated by formrepeater
            if($categories){
                foreach($categories as $category){
                    foreach($category as $key => $_data){
                        $product_category = new ProductCategory();
                        $product_category->product_id = $product->id;
                        $product_category->category_id = $_data;
                        //dd($_data);
                        $product_category->save();
                    }            
                }
            }

            /* Brands */ 
            $brands = $request->brand__repeaterBasic;
            if($brands){
                foreach($brands as $brand){
                    foreach($brand as $key => $_data){
                        $product_brand = new ProductBrand();
                        $product_brand->product_id = $product->id;
                        $product_brand->brand_id = $_data;
                        $product_brand->save();
                    }            
                }
            }           
            /* Tags */ 
            $tags = $request->tag__repeaterBasic;  // Is generated by formrepeater
            if($tags){
                foreach($tags as $tag){
                    foreach($tag as $key => $_data){
                        $product_tag = new ProductTag();
                        $product_tag->product_id = $product->id;
                        $product_tag->tag_id = $_data;
                        $product_tag->save();
                    }            
                }
            } 
            /* Product Images */
            if( $request->file('product_images') ){
                $images = $request->file('product_images'); 
                foreach($images as $image){
                    $product_images = new ProductImage();
                    $product_images->product_id = $product->id;
                    $image_extension = strtolower($image->getClientOriginalExtension());
                    $image_name = hexdec(uniqid()) . '.' . $image_extension;
                    $upload_location = 'storage/products/images/';
                    if($product_images->image){
                        unlink($upload_location . $product_images->image);
                        $image->move($upload_location, $image_name);
                        $product_images->image = $image_name;                      
                    }else{
                        $image->move($upload_location, $image_name);
                        $product_images->image = $image_name;
                    }                
                    $product_images->save();
                }         
            }
            /* Product Metas */
            $product_meta = new ProductMeta();
            $product_meta->product_id = $product->id; 
            $product_meta->title = $request->meta_title;  
            $product_meta->description = $request->meta_description; 
            $product_meta->keywords = $request->meta_keywords;
            $product_meta->save(); 
            /* Product Discount */
            $product_discount = new Discount();
            $product_discount->product_id = $product->id; 
            $product_discount->name = $request->discount_option;
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
             /* Tags */ 
             $variations = $request->variation__addOptions; // Is generated by formrepeater
             if($variations){
                foreach($variations as $variation => $_data){    
                    $product_variation = new Variation();
                    $product_variation->product_id = $product->id;
                    //dd($product_variation->product_id);
                    $product_variation->name = $_data[0];
                    $product_variation->value = $_data[1];
                    //dd($product_variation->value);
                    $product_variation->save();              
                }
             }
        });

        $notification = [
            'message' => 'Product Added Successfully!!...',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.products')->with($notification);
    }

    public function edit($id){
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        $data['brands'] = Brand::all();
        $data['product_metas'] = ProductMeta::where('product_id', $id)->get();
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
        return view('backend.products.edit', $data);
    }

    public function view($id){
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        $data['brands'] = Brand::all();
        $data['product_metas'] = ProductMeta::where('product_id', $id)->get();
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
        return view('backend.products.view', $data);
    }

    public function update(Request $request, $id){
        DB::transaction(function() use($request, $id){
            /* Product */
            $product = Product::find($id);
            if( $request->file('product_thumbnail') ){
                $product_thumbnail = $request->file('product_thumbnail');
                $image_extension = strtolower($product_thumbnail->getClientOriginalExtension());
                $image_name = date('YmdHi'). '.' . $image_extension;
                $upload_location = 'storage/products/thumbnail/';
                if($product->image){
                    unlink($upload_location . $product->image);
                    $product_thumbnail->move($upload_location, $image_name);
                    $product->product_thumbnail = $image_name;                      
                }else{
                    $product_thumbnail->move($upload_location, $image_name);
                    $product->product_thumbnail = $image_name;
                }          
            }
            $product->name = $request->product_name;
            $product->description = $request->product_description;
            $product->short_description = $request->product_short_description;
            $product->type = $request->product_type;
            $product->status = $request->product_status;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->serialnumber = $request->serialnumber;
            $product->qrcode = $request->qrcode;
            $product->price = $request->product_price;
            $product->zwl_price = $request->zwl_product_price;
            $product->physical_delivery = $request->physical_delivery;
            $product->weight = $request->product_weight;
            $product->width = $request->product_width;
            $product->height = $request->product_height;
            $product->length = $request->product_length;
            $product->save();

            /* User Product Link */
            if(UserProduct::where('product_id', '=', $product->id)->exists()){
                $user_product = UserProduct::where('product_id', $product->id)->first();
                $user_product->user_id = Auth::user()->id;
                $user_product->save();
            } else{
                $user_product = new UserProduct();
                $user_product->user_id = Auth::user()->id;
                $user_product->product_id = $product->id;
                $user_product->save();
            }     
            /* Category Products */
            $categories = $request->category__repeaterBasic;  // Is generated by formrepeater
            $product_category = ProductCategory::where('product_id', $product->id)->delete();  // Is generated by formrepeater
            if($categories){
                foreach($categories as $category){
                    foreach($category as $key => $_data){
                        $product_category = new ProductCategory();
                        $product_category->product_id = $product->id;
                        $product_category->category_id = $_data;
                        //dd($_data);
                        $product_category->save();
                    }            
                }
            }
            /* Brands */ 
            $brands = $request->brand__repeaterBasic;
            $product_brand = ProductBrand::where('product_id', $product->id)->delete();
            if($brands){
                foreach($brands as $brand){
                    foreach($brand as $key => $_data){
                        $product_brand = new ProductBrand();
                        $product_brand->product_id = $product->id;
                        $product_brand->brand_id = $_data;
                        $product_brand->save();
                    }            
                }
            }           
            /* Tags */ 
            $tags = $request->tag__repeaterBasic;  // Is generated by formrepeater
            $product_tag = ProductTag::where('product_id', $product->id)->delete();
            if($tags){
                foreach($tags as $tag){
                    foreach($tag as $key => $_data){
                        $product_tag = new ProductTag();
                        $product_tag->product_id = $product->id;
                        $product_tag->tag_id = $_data;
                        $product_tag->save();
                    }            
                }
            } 
            /* Product Images */
            if( $request->file('product_images') ){
                $images = $request->file('product_images');
                $product_images = ProductImage::where('product_id', $product->id)->delete();
                foreach($images as $image){
                    $product_images = new ProductImage();
                    $product_images->product_id = $product->id;

                    $image_extension = strtolower($image->getClientOriginalExtension());
                    $image_name = hexdec(uniqid()) . '.' . $image_extension;
                    $upload_location = 'storage/products/images/';    
                    if($product_images->image){
                        unlink($upload_location . $product_images->image);
                        $image->move($upload_location, $image_name);                     
                    } else{
                        $image->move($upload_location, $image_name);
                        $product_images->image = $image_name;
                    }          
                    $product_images->save();
                }         
            }
            /* Product Metas */
            $product_meta = ProductMeta::where('product_id', $product->id)->first();
            $product_meta->title = $request->meta_title;  
            $product_meta->description = $request->meta_description; 
            $product_meta->keywords = $request->meta_keywords;
            $product_meta->save(); 
            /* Product Discount */
            $product_discount = Discount::where('product_id', $product->id)->first(); 
            $product_discount->name = $request->discount_option;
            $product_discount->discount_percent = $request->discount_percent;
            $product_discount->save();
            /* Product Tax */
            $product_tax = Tax::where('product_id', $product->id)->first();
            $product_tax->name = $request->tax_name;
            $product_tax->amount_percent = $request->tax_amount_percent;
            $product_tax->save();
            /* Product Inventory */
            $product_inventory = Inventory::where('product_id', $product->id)->first();
            $product_inventory->in_store_quantity = $request->in_store_quantity;
            $product_inventory->in_warehouse_quantity = $request->in_warehouse_quantity;
            $product_inventory->save();
             
            /* ::::: Variations ::::: */            
             $variation_from_db = $request->variation_from_db;
             if($variation_from_db){
                $product_var = Variation::where('product_id', $product->id)->delete();
                foreach($variation_from_db as $_data){
                    $product_var = new Variation();
                    $product_var->product_id = $product->id;
                    $product_var->name = $_data[0];
                    $product_var->value = $_data[1];
                    $product_var->save();
                }  
             }
             $variations = $request->variation__addOptions; // Is generated by formrepeater
             if($variations[0][0] != NULL && $variations[0][1] != NULL){
                // dd($variations);
                foreach($variations as $variation => $_data){    
                    $product_variation = new Variation();
                    $product_variation->product_id = $product->id;
                    $product_variation->name = $_data[0];
                    $product_variation->value = $_data[1];
                    $product_variation->save();              
                }
             }
        });

        $notification = [
            'message' => 'Product Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.products')->with($notification);
    }

    public function delete($id){
        DB::transaction(function() use($id){
            /* Product */
            $product = Product::find($id);
            $product->delete();
            if($product->product_thumbnail != NULL){ 
                $image = public_path() . '/storage/products/thumbnail/' . $product->product_thumbnail;
                if(File::exists($image)){ 
                    Storage::delete($image);
                }
            }  
            /* User Product Link */
            $user_product = UserProduct::where('product_id', $product->id);
            $user_product->delete(); 
            /* Category Products */
            $product_category = ProductCategory::where('product_id', $product->id);
            $product_category->delete();
            /* Brands */ 
            $product_brand = ProductBrand::where('product_id', $product->id);
            $product_brand->delete();     
            /* Tags */ 
            $product_tag = ProductTag::where('product_id', $product->id);
            $product_tag->delete();
            /* Product Metas */
            $product_meta = ProductMeta::where('product_id', $product->id);
            $product_meta->delete();
            /* Product Discount */
            $product_discount = Discount::where('product_id', $product->id);
            $product_discount->delete();
            /* Product Tax */
            $product_tax = Tax::where('product_id', $product->id);
            $product_tax->delete();
             /* Product Inventory */
            $product_inventory = Inventory::where('product_id', $product->id);
            $product_inventory->delete();
             /* Variations */ 
             $product_variation = Variation::where('product_id', $product->id);
             $product_variation->delete();

             /* Product Images */ 
             $product_images_from_db = ProductImage::where('product_id', $product->id)->get();
            if($product_images_from_db != NULL) { 
                foreach($product_images_from_db as $product_image){
                    $image = public_path() . 'storage/products/images/' . $product_image->image ;
                    if(File::exists($image)){
                        Storage::delete($image);
                    }
                }
                $product_images = ProductImage::where('product_id', $product->id);
                $product_images->delete();
            }  
            
        });

        $notification = [
            'message' => 'Product Deleted Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.products')->with($notification);
    }
}

