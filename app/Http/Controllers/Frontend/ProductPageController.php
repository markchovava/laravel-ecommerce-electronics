<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Models\UserProduct;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductMeta;
use App\Models\Product\ProductTag;
use App\Models\Product\ProductBrand;
use App\Models\Product\Tag\Tag;
use App\Models\Product\Tax;
use App\Models\Product\Brand;
use App\Models\Product\CategoryProduct;
use App\Models\Product\Discount;
use App\Models\Product\Inventory;
use App\Models\Product\Variation;
use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Backend\BasicInfo;

class ProductPageController extends Controller
{

    public function randomString($length) {
        $keys = array_merge(range(0,9), range('a', 'z'));
        $key = "";
        for($i=0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }
    public function view($id){
        $data['role_id'] = CheckRoles::check_role();
        
        if( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
            } 
        }
        elseif( !(isset($_COOKIE['shopping_session'])) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }

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

        $data['accesories'] = Product::with('categories')->whereHas('categories', function($query){
            $query->where('slug', 'LIKE', '%accesories%'); //this refers slug field from tags table
        })
        ->orderBy('id','desc')
        ->paginate(3);

        $data['tag_trending'] = Tag::where('slug', 'LIKE', '%latest%')->first();
        $data['trending_products'] =Product::with('tags')->whereHas('tags', function($query){
            $query->where('tags.slug', 'LIKE', '%latest%'); //this refers slug field from tags table
        })
        ->orderBy('id','desc')
        ->paginate(4);

        /*  
        *   Brands 
        */
        $data['brands'] = Brand::latest()->paginate(10);
        /* 
        *  Main Web Info 
        */
        $data['info'] = BasicInfo::first();

        return view('frontend.pages.single', $data);
    }

    public function cart_store(Request $request){  
        if( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $cart = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            $cart->customer_id = Auth::id();
            $cart->save();
            /* 
            *   Cart Id 
            */
            $cart_id = $cart->id; 
            /* 
            *   Add CartItem
            */   
            $product_id = $request->product_id;
            $cart_item = CartItem::where('product_id', $product_id)->first();;
            $cart_item->cart_id = $cart_id;
            if(!empty($cart_item->quantity)){
                $quantity = intval($cart_item->quantity) + intval($request->product_quantity);
            }else{
                $quantity = $request->product_quantity;
            }
            $cart_item->quantity = $quantity;
            $cart_item->product_id = $request->product_id;
            if($request->product_variation != ''){
                $cart_item->product_variation = $request->product_variation;
            }
            $cart_item->save();
                
            /* 
            *   Saves new quantity in store 
            */
            if($request->in_store_quantity){
                $in_store_quantity = intval($request->in_store_quantity) - intval($request->product_quantity);
            }else{
                $in_store_quantity = $request->in_store_quantity;
            }  
            $product = Product::find($request->product_id);
            $inventory_id = $product->inventories->id;
            $inventory = Inventory::find($inventory_id);
            $inventory->in_store_quantity = $in_store_quantity;
            $inventory->save();
               
            $notification = [
                'message' => 'Added to cart Successfully.',
                'alert-type' => 'info'
            ];
            return redirect()->back(); 
            
        }
        elseif( !(isset($_COOKIE['shopping_session'])) ){
            $cart = new Cart();
            $shopping_session = $this->randomString(30);
            $cart->shopping_session = $shopping_session;
            if( auth()->check() ){
                $cart->customer_id = Auth::id();
            }
            $cart->total = $request->price_cents;
            $cart->save();   
            setcookie('shopping_session', $shopping_session, time() + (86400 * 7), "/"); 
            // Cart Item
            $cart_item = new CartItem();
            $cart_item->cart_id = $cart->id;
            $cart_item->product_id = $request->product_id;
            $product = Product::find($request->product_id);
            if(!empty($product->inventories->in_store_quantity)){
                $quantity = $product->inventories->in_store_quantity; 
            }else{
                $quantity = null;
            }
            
            /* 
            *   Add Quantity in Cart Items 
            *   and Deduct quantity in Inventory 
            */
            if(intval($quantity) > 10){
                $inventory = Inventory::where('product_id', $request->product_id)->first();
                $inventory = Inventory::find($inventory->id);
                $deduct_instore = intval($inventory->in_store_quantity) - intval($request->in_store_quantity);
                $inventory->in_store_quantity = $deduct_instore;
                $inventory->save();
                $quantity = intval($request->in_store_quantity);
                $cart_item->quantity = $quantity; 
            }  
            if($request->variation_name != false && $request->variation_value != false){
                $cart_item->variation_name = $request->variation_name;
                $cart_item->variation_value = $request->variation_value;
            }
            $cart_item->save();

            $notification = [
                'message' => 'Successfully Added to Cart.',
                'alert-type' => 'danger'
            ];
            
            return redirect()->back()->with($notification);
        }   
    }
}
