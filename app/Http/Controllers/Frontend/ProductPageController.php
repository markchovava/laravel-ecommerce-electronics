<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

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
use App\Models\Miscellaneous\Miscellaneous;
use App\Models\Backend\BasicInfo;
use App\Models\Product\Specification\Specification;

class ProductPageController extends Controller
{

    public function view($id){
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        /*  IP Address */
        $ip_address = $this->ip();
        //dd($shopping_session);
        if( isset($shopping_session) || isset($ip_address) ){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
                //dd($data['cart_quantity']);
            } 
        }
        elseif( !(isset($shopping_session)) || !isset($ip_address) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }

        
        $data['product_metas'] = ProductMeta::where('product_id', $id)->get();
        $data['product_images'] = ProductImage::where('product_id', $id)->get();
        $data['discounts'] = Discount::where('product_id', $id)->get();
        $data['inventories'] = Inventory::where('product_id', $id)->get();
        $data['taxes'] = Tax::where('product_id', $id)->get();
        $data['variations'] = Variation::where('product_id', $id)->get();
        $data['specifications'] = Specification::where('product_id', $id)->get();
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
        *   Footer Products 
        *   3 First Tag, Trending Products 
        */
        $data['tag_first_three'] = Product::whereHas('tags', function($query){
            $query->where('position', 'First'); //this refers id field from categories table
        })
        ->orderBy('updated_at','desc')
        ->paginate(3);

        /* 
        *   3 Latest Products 
        */
        $data['latest_three'] = Product::latest()->paginate(3);

        /* 
        *  3 Daily Hot Products 
        */
        $data['tag_second_three'] = Product::whereHas('tags', function($query){
            $query->where('position', 'Second'); //this refers id field from categories table
        })
        ->orderBy('updated_at','desc')
        ->paginate(3);

        /*  
        *   Brands 
        */
        $data['brands'] = Brand::latest()->paginate(10);
        /*
        *   ZWL Currency Value 
        */
        $data['currency'] = Miscellaneous::where('name', 'ZWL')->first();
        /* 
        *  Main Web Info 
        */
        $data['info'] = BasicInfo::first();

        /* Categories */
        $footer_categories = Category::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_categories'] = (!empty($footer_categories)) ? $footer_categories : NULL;
        /* Tags */
        $footer_tags = Tag::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_tags'] = (!empty($footer_tags)) ? $footer_tags : NULL;
        /* Brands */
        $footer_brands = Brand::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_brands'] = (!empty($footer_brands)) ? $footer_brands : NULL;

        return view('frontend.pages.single', $data);
    }

    

    public function cart_store(Request $request){  
        $ip_address = $this->ip();
        if(auth()->check()){
            $customer_id = Auth::user()->id;
        }
        $shopping_session = Cookie::get('shopping_session'); 
        if(isset($shopping_session) || isset($ip_address)){
            $db_shopping_session = Cart::where('shopping_session', $shopping_session)->first();
            $db_ip_address = Cart::where('ip_address', $ip_address)->first();
            if( isset($db_shopping_session) || isset( $db_ip_address) ){
                $cart = Cart::where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
                $cart->customer_id = isset($customer_id) ? $customer_id : NULL;
                if( !(isset($cart->shopping_session)) ){
                    $cart->shopping_session = $shopping_session;
                }
                if( !(isset($cart->ip_address)) ){
                    $cart->ip_address = $ip_address;
                }
                $cart->save();
                $cart_item = CartItem::where('cart_id', $cart->id)->first();
                if( isset($cart_item)){
                    $cart_item->product_id = $request->product_id;
                    $cart_item->quantity = (isset($cart_item->quantity)) ? $request->product_quantity + $cart_item->quantity : $request->product_quantity;
                    $cart_item->product_variation = (isset($request->product_variation)) ? $request->product_variation : NULL; 
                    $cart_item->save();
                    //dd('1 here');
                } else{
                    $cart_item = new CartItem();
                    $cart_item->cart_id = $cart->id;
                    $cart_item->product_id =  $request->product_id;
                    $cart_item->quantity = $request->product_quantity;
                    $cart_item->product_variation = (isset($request->product_variation)) ? $request->product_variation : NULL; 
                    $cart_item->save();
                    //dd('2 here');
                }
                /*   Saves new quantity in store    */
                if( isset($request->in_store_quantity) ){
                    $in_store_quantity = intval($request->in_store_quantity) - intval($request->product_quantity);
                    $product = Product::find($request->product_id);
                    $inventory_id = $product->inventories->id;
                    $inventory = Inventory::find($inventory_id);
                    $inventory->in_store_quantity = $in_store_quantity;
                    $inventory->save();
                } else{
                    $in_store_quantity = $request->in_store_quantity;
                    $product = Product::find($request->product_id);
                    $inventory_id = $product->inventories->id;
                    $inventory = Inventory::find($inventory_id);
                    $inventory->in_store_quantity = $request->in_store_quantity;
                    $inventory->save();
                }  
                $notification = [
                    'message' => 'Added to cart Successfully.',
                    'alert-type' => 'info'
                ];
                return redirect()->back()->with($notification);       
            }else{
                $cart = new Cart();
                $cart->shopping_session = $shopping_session;
                $cart->ip_address = $ip_address;
                $cart->customer_id = $customer_id;
                $cart->save();
                /* Cart Item */
                $cart_item = CartItem::where('cart_id', $cart->id)->first();
                //dd($cart_item);
                if(!isset($cart_item)){
                    $cart_item = new CartItem();
                    $cart_item->cart_id = $cart->id;
                    $cart_item->product_id =  $request->product_id;
                    $cart_item->quantity = $request->product_quantity;
                    $cart_item->product_variation = (isset($request->product_variation)) ? $request->product_variation : NULL; 
                    $cart_item->save();
                    /* Creating cookie */
                    $shopping_session = $this->randomString(30);
                    Cookie::queue('shopping_session', $shopping_session, 10080);
                    //dd('4 here');
                } elseif($cart_item->product_id == $request->product_id){
                    $cart_item->cart_id = $cart->id;
                    $cart_item->quantity = (isset($cart_item->quantity)) ? $request->product_quantity + $cart_item->quantity : $request->product_quantity;
                    $cart_item->product_variation = (isset($request->product_variation)) ? $request->product_variation : NULL; 
                    $cart_item->save();
                    //dd('3 here');
                }
                /*   Saves new quantity in store    */
                if( isset($request->in_store_quantity) ){
                    $in_store_quantity = intval($request->in_store_quantity) - intval($request->product_quantity);
                    $product = Product::find($request->product_id);
                    $inventory_id = $product->inventories->id;
                    $inventory = Inventory::find($inventory_id);
                    $inventory->in_store_quantity = $in_store_quantity;
                    $inventory->save();
                }else{
                    $in_store_quantity = $request->in_store_quantity;
                    $product = Product::find($request->product_id);
                    $inventory_id = $product->inventories->id;
                    $inventory = Inventory::find($inventory_id);
                    $inventory->in_store_quantity = $request->in_store_quantity;
                    $inventory->save();
                }  
                $notification = [
                    'message' => 'Added to cart Successfully.',
                    'alert-type' => 'info'
                ];
                return redirect()->back()->with($notification); 
            }
        }else{
            /* Creating cookie */
            $shopping_session = $this->randomString(30);
            Cookie::queue('shopping_session', $shopping_session, 10080);
            /* New Cart */
            $cart = new Cart();
            $cart->shopping_session = $shopping_session;
            $cart->ip_address = $ip_address;
            $cart->customer_id = $customer_id;
            $cart->save();
            /* Cart Item */
            $cart_item = CartItem::where('cart_id', $cart->id)->first();
            if(!isset($cart_item)){
                $cart_item = new CartItem();
                $cart_item->cart_id = $cart->id;
                $cart_item->product_id =  $request->product_id;
                $cart_item->quantity = $request->product_quantity;
                $cart_item->product_variation = (isset($request->product_variation)) ? $request->product_variation : NULL; 
                $cart_item->save();
                //dd('6 here');
            }elseif($cart_item->product_id == $request->product_id){
                $cart_item->cart_id = $cart->id;
                $cart_item->quantity = (isset($cart_item->quantity)) ? $request->product_quantity + $cart_item->quantity : $request->product_quantity;
                $cart_item->product_variation = (isset($request->product_variation)) ? $request->product_variation : NULL; 
                $cart_item->save();
                //dd('5 here');
            }   
            /*   Saves new quantity in store    */
            if( !empty($request->in_store_quantity) ){
                $in_store_quantity = intval($request->in_store_quantity) - intval($request->product_quantity);
                $product = Product::find($request->product_id);
                $inventory_id = $product->inventories->id;
                $inventory = Inventory::find($inventory_id);
                $inventory->in_store_quantity = $in_store_quantity;
                $inventory->save();
            }else{
                $in_store_quantity = $request->in_store_quantity;
                $product = Product::find($request->product_id);
                $inventory_id = $product->inventories->id;
                $inventory = Inventory::find($inventory_id);
                $inventory->in_store_quantity = $request->in_store_quantity;
                $inventory->save();
            }  
            $notification = [
                'message' => 'Added to cart Successfully.',
                'alert-type' => 'info'
            ];
            return redirect()->back()->with($notification); 
        }     
    }


    /* 
    *   Generate random string
    */
    public function randomString($length) {
        $keys = array_merge(range(0,9), range('a', 'z'));
        $key = "";
        for($i=0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }

    /* 
    *   Get Ip
    */
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
    public function ip(){
        return $this->getIp(); // the above method
    }

}
