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

    public $shopping_session;
    public $ip_address;
    
    public function view($id){
        /*  
        *    Check Roles
        */
        $data['role_id'] = CheckRoles::check_role();
        /* 
        *   Check Cookie 
        */
        if( isset($_COOKIE['shopping_session'])){
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

        return view('frontend.pages.single', $data);
    }

    

    public function cart_store(Request $request){  
        $ip_address = $this->ip();
        $cart = Cart::where('ip_address', $ip_address)->first();
        /* 
        *   Checks if Cookie is present 
        */
        $shopping_session = Cookie::get('shopping_session'); 
        
        if( isset($shopping_session) ){
            dd($shopping_session);
            /* Checks if shopping session is in database */
            $cart = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            if( !empty($cart) ){
                /*  Get IP Address, ip() is in this class   */
                $cart->ip_address = $this->ip();
                /*   Check user is Logged in   */
                if(auth()->check()){
                    $cart->customer_id = Auth::id();
                }
                /* Adding Total to DB */
                if(!empty($cart->total)){
                    $cart->total = ($cart->quantity * intval($request->discounted_usd_priceCents)) + $cart->total;
                }else{
                    $cart->total = $cart->quantity; 
                }
                /* Save Cart */
                $cart->save();
                /* 
                *   Add CartItem
                */   
                $product_id = $request->product_id;
                $cart_item = CartItem::where('product_id', $product_id)->first();
                if( !empty($cart_item) ){
                    $cart_item->cart_id = $cart->id;
                    if( !empty($cart_item->quantity) ){
                        $quantity = intval($cart_item->quantity) + intval($request->product_quantity);
                    }else{
                        $quantity = $request->product_quantity;
                    }
                    $cart_item->quantity = $quantity;
                    if( !empty($request->product_variation) ){
                        $cart_item->product_variation = $request->product_variation;
                    }
                    $cart_item->save();
                } else{
                    $cart_item = new CartItem();
                    $cart_item->product_id = $request->product_id;
                    $cart_item->cart_id = $cart->id;
                    $cart_item->quantity = $request->product_quantity;
                    if( !empty($request->product_variation) ){
                        $cart_item->product_variation = $request->product_variation;
                    }
                    $cart_item->save();
                } 
                 /* 
                *   Saves new quantity in store 
                */
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
                /* Save Cart Item */
                return redirect()->back(); 

            } else{
                $cart = new Cart();
                $cart->ip_address = $this->ip();
                $shopping_session = $this->randomString(30);
                /*  Save Shopping Session as a Cookie    */
                $cart->shopping_session = $shopping_session;
                Cookie::queue('shopping_session', $shopping_session, 10080);
                /*  Check user is Logged in */
                if(auth()->check()){
                    $cart->customer_id = Auth::id();
                }
                $cart->save();
                /* 
                *   Add CartItem
                */
                $product_id = $request->product_id;
                $cart_item = CartItem::where('product_id', $product_id)->first();
                if(!empty($cart_item)){
                    $cart_item->cart_id = $cart->id;
                    if( !empty($cart_item->quantity) ){
                        $cart_item->quantity = intval($cart_item->quantity) + intval($request->product_quantity);
                    }else{
                        $cart_item->quantity = $request->product_quantity;
                    }
                    /* Variations */
                    if( !empty($request->product_variation) ){
                        $cart_item->product_variation = $request->product_variation;
                    }
                    /* Save Cart Item */
                    $cart_item->save();
                } else{
                    /** 
                    *   Add Cart Item 
                    **/
                    $cart_item = new CartItem();
                    $cart_item->product_id = $request->product_id;
                    $cart_item->cart_id = $cart->id;
                    if(!empty($cart_item->quantity)){
                        $cart_item->quantity = intval($cart_item->quantity) + intval($request->product_quantity);
                    }else{
                        $cart_item->quantity = $request->product_quantity;
                    }
                    if( !empty($request->product_variation) ){
                        $cart_item->product_variation = $request->product_variation;
                    }
                    $cart_item->save();
                }

                 /* 
                *   Saves new quantity in store 
                */
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
                return redirect()->back();    
            }               
            /* 
            *   Saves new quantity in store 
            */
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
            return redirect()->back();  
        } elseif( !(isset($_COOKIE['shopping_session'])) ){
            $cart = new Cart();
            $cart->ip_address = $this->ip();
            $shopping_session = $this->randomString(30);
            $cart->shopping_session = $shopping_session;
            /* Save Shopping Session as a Cookie */
            Cookie::queue('shopping_session', $shopping_session, 20);
            /* Check if User is logged in */
            if( auth()->check() ){
                $cart->customer_id = Auth::id();
            }
            $cart->save();   
            /* 
            *   Add CartItem
            */
            $product_id = $request->product_id;
            $cart_item = CartItem::where('product_id', $product_id)->first();
            if(!empty($cart_item)){
                $cart_item->cart_id = $cart->id;
                if(!empty($cart_item->quantity)){
                    $quantity = intval($cart_item->quantity) + intval($request->product_quantity);
                }else{
                    $quantity = $request->product_quantity;
                }
                $cart_item->quantity = $quantity;
                if( !empty($request->product_variation) ){
                    $cart_item->product_variation = $request->product_variation;
                }
                $cart_item->save();
            } else{
                $cart_item = new CartItem();
                $cart_item->product_id = $request->product_id;
                $cart_item->cart_id = $cart->id;
                $quantity = $request->product_quantity;
                if( !empty($request->product_variation) ){
                    $cart_item->product_variation = $request->product_variation;
                }
                $cart_item->save();
            }
            /* 
            *   Saves new quantity in store 
            */
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
            /* Redirect Back to Product Page */
            return redirect()->back();
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
