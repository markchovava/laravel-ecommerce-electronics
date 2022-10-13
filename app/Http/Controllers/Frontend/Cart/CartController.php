<?php

namespace App\Http\Controllers\Frontend\Cart;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Product\Inventory;
use App\Models\Product\Product;
use App\Models\Backend\BasicInfo;
use App\Models\Miscellaneous\Miscellaneous;
use App\Models\Product\Brand;
use App\Models\Product\Category;
use App\Models\Product\Tag\Tag;
use App\Models\Quote\CustomerQuote;
use App\Models\Shipping\Shipping;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

    public function add(Request $request){
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        /*  IP Address */
        $ip_address = $this->ip();
        /* Customer ID */
        if( !(isset($shopping_session)) || !isset($ip_address) ){
            $cart = new Cart();
            $shopping_session = $this->randomString(30);
            $cart->shopping_session = $shopping_session;
            if(auth()->check()){
                $cart->customer_id = Auth::user()->id;
            }
            $cart->total = $request->price_cents;
            $cart->save();   
            Cookie::queue('shopping_session', $shopping_session, 10080);
            //setcookie('shopping_session', $shopping_session, time() + (86400 * 7), "/"); 
            // Cart Item
            $cart_item = new CartItem();
            $cart_item->cart_id = $cart->id;
            $cart_item->product_id = $request->product_id;
            $product = Product::find($request->product_id);
            $quantity = $product->inventories->in_store_quantity; 
            /* Add Quantity in Cart Items and Deduct quantity in Inventory */
            if(intval($quantity) > 10){
                $inventory = Inventory::where('product_id', $request->product_id)->first();
                $inventory = Inventory::find($inventory->id);
                $deduct_instore = intval($inventory->in_store_quantity) - 1;
                $inventory->in_store_quantity = $deduct_instore;
                $inventory->save();
                $quantity = $product->inventories->in_store_quantity;
                $cart_item->quantity++; 
            }  
            if( isset($request->product_variation) ){
                $cart_item->product_variation = $request->product_variation;
            }
            $cart_item->save();
        }
        elseif( isset($shopping_session) || isset($ip_address) ){
            $cart = Cart::where('shopping_session', $shopping_session)
                        ->orWhere('ip_address', $ip_address)
                        ->first();
            if(!empty($cart)){
                if(auth()->check()){
                    $cart->customer_id = Auth::id();
                }
                $cart->total = isset($cart->total) ? (int)$cart->ttotal + (int)$request->price_cents : $request->price_cents;
                $cart->save();
            } 
            elseif( empty($cart) ){
                $cart = new Cart();
                $cart->shopping_session = $shopping_session;
                $cart->ip_address = $this->ip();
                if(auth()->check()){
                    $customer_id = Auth::id();
                    $cart->customer_id = $customer_id;
                }
                $cart->total = isset($cart->total) ? (int)$cart->ttotal + (int)$request->price_cents : $request->price_cents;
                $cart->save();

            }
            $product_id = (int)$request->product_id;
            $cart_item = CartItem::where('product_id', $product_id)->first();
            if(!empty($cart_item)){
                $cart_item->cart_id = $cart->id;
                $product = Product::find($request->product_id);
                $quantity = $product->inventories->in_store_quantity; 
                 /* Add Quantity in Cart Items and Deduct quantity in Inventory */
                if((int)$quantity > 10){
                    $inventory = Inventory::where('product_id', $product_id)->first();
                    $inventory = Inventory::find($inventory->id);
                    $deduct_instore = intval($inventory->in_store_quantity) - 1;
                    $inventory->in_store_quantity = $deduct_instore; 
                    $inventory->save();
                    $quantity = $product->inventories->in_store_quantity;
                    $cart_item->quantity++; 
                }     
                if( !empty($request->product_variation) ){
                    $cart_item->product_variation = $request->product_variation;
                }
                $cart_item->save();
            } 
            elseif(empty($cart_item)){
                $cart_item = new CartItem();
                $cart_item->product_id = $request->product_id;
                $cart_item->cart_id = $cart->id;
                $product = Product::find($request->product_id);
                $quantity = $product->inventories->in_store_quantity; 
                 /* Add Quantity in Cart Items and Deduct quantity in Inventory */
                if(intval($quantity) > 10){
                    $inventory = Inventory::where('product_id', $request->product_id)->first();
                    $inventory = Inventory::find($inventory->id);
                    $deduct_instore = (int)$inventory->in_store_quantity - 1;
                    $inventory->in_store_quantity = $deduct_instore;  
                    $inventory->save();
                    $quantity = $product->inventories->in_store_quantity;
                    $cart_item->quantity++; 
                }  
                if(!empty($request->product_variation)){
                    $cart_item->product_variation = $request->product_variation;
                }
                $cart_item->save();
            }
        
        } else{
            return false;
        }
        return redirect()->route('cart.view');      
    }

    public function store(Request $request){
         /*   Check Roles    */
         $data['role_id'] = CheckRoles::check_role();
         /*  Check Cookie */
         $shopping_session = Cookie::get('shopping_session');
         /*  IP Address */
         $ip_address = $this->ip();
        /* Auth Id */
         //dd($customer_id);
         
        if( !(Auth::check()) ){
            return redirect()->route('checkout.login');
        }
        else{
            $customer_id = Auth::id();
            if( isset($shopping_session) || isset($ip_address) ){
                $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
                $data['cart']->customer_id = $customer_id;
                $data['cart']->shipping_fee = $request->shipping_feeCents;
                $data['cart']->cart_subtotal = $request->cart_subtotalCents;
                $data['cart']->total = $request->cart_totalCents;
                $data['cart']->zwl_total = $request->cart_zwltotalCents;
                $data['cart']->save();
                $cart_id = $data['cart']->id;
                $old_cart_items = CartItem::where('cart_id', $cart_id)->delete();
                $product_id = $request->product_id;
                if(isset($product_id)){
                    $count_id = count($request->product_id);
                    for($i = 0; $i < $count_id; $i++){
                        $cart_items = new CartItem();
                        $cart_items->cart_id = $cart_id;
                        $cart_items->quantity = $request->product_quantity[$i];
                        //dd($cart_items->quantity);
                        $cart_items->product_id = $request->product_id[$i];
                        if($request->product_variation != ''){
                            $cart_items->product_variation = $request->product_variation;
                        }
                        $cart_items->save();
                    }
                    /* Saves new quantity in store */
                    $in_store_quantity =  $request->in_store_quantity;
                    for($i = 0; $i < $count_id; $i++){
                        $product = Product::find($request->product_id[$i]);
                        $inventory_id = $product->inventories->id;
                        $inventory = Inventory::find($inventory_id);
                        $inventory->in_store_quantity = $in_store_quantity[$i];
                        $inventory->save();
                        //dd($inventory->in_store_quantity);
                    }
                    return redirect()->route('checkout'); 
                }
            }
            elseif( !(isset($shopping_session)) || !isset($ip_address) ){
                $notification = [
                    'message' => 'You need Products in the Cart to Proceed to Checkout.',
                    'alert-type' => 'danger'
                ];
                
                    return redirect()->route('index')->with($notification);
            }
        }
    }

    public function view(){
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        /*  IP Address */
        $ip_address = $this->ip();

        if( isset($shopping_session) || isset($ip_address) ){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
            if(!empty($data['cart'])){
                $data['quantity'] = $data['cart']->cart_items->sum('quantity');
            } else{
                $data['quantity'] = 0;
            }     
        }
        elseif( !isset($shopping_session) || !isset($ip_address) ){
            $data['cart'] = NULL;
            $data['quantity'] = 0;
        }
        return response()->json($data);
    }

    public function index(){
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        $quote_session = Cookie::get('quote_session');
        /*  IP Address */
        $ip_address = $this->ip();
        /* Shopping Quote */
        if( isset($quote_session) || $ip_address){
            $quote = CustomerQuote::with('customer_quote_items')
                    ->where('quote_session', $shopping_session)
                    ->orWhere('ip_address', $ip_address)->first();
            $data['quote'] = $quote;
            if( !empty($data['quote']) ){
                $data['quote_quantity'] = $data['quote']->customer_quote_items->sum('quantity');
            } 
        }
        elseif( !(isset($quote_session)) || !isset($ip_address) ){
            $data['quote'] = NULL;
            $data['quote_quantity'] = 0;
        }
        /* Shopping Cart */
        if( isset($shopping_session) || isset($ip_address)){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)
                                                    ->orWhere('ip_address', $ip_address)->first();
            if( !empty($data['cart']) ){
                //dd($data['cart']);
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
                $cart_id =  $data['cart']->id;
                $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
                /* 
                *   Shipping Fee 
                */
                $data['shipping'] = Shipping::first();
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
                /*  */
                return view('frontend.pages.cart', $data);
            } else{
                //dd('Cart Empty');
                $data['cart_quantity'] = 0;
                $data['message'] = "The Shopping Cart is empty at the moment.";
                /* 
                *   Shipping Fee 
                */
                $data['shipping'] = Shipping::first();
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
                
                return view('frontend.pages.cart', $data);
            }           
        } 
        //dd('Here');
        $data['cart_quantity'] = 0;
        $data['message'] = "The Shopping Cart is empty at the moment.";
        /* 
        *   Shipping Fee 
        */
        $data['shipping'] = Shipping::first();
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
        
        /* Return Page */
        return view('frontend.pages.cart', $data);     
    }

    public function delete($id){
        $data['cart_item'] = CartItem::find($id);
        $data['cart_item']->delete();
        return response()->json('Deleted Successfully!...');
    }


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
