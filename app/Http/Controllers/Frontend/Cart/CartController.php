<?php

namespace App\Http\Controllers\Frontend\Cart;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Product\Product;

class CartController extends Controller
{
    public function randomString($length) {
        $keys = array_merge(range(0,9), range('a', 'z'));
        $key = "";
        for($i=0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }

    public function add(Request $request){
        if( !(isset($_COOKIE['shopping_session'])) ){
            $cart = new Cart();
            $shopping_session = $this->randomString(30);
            $cart->shopping_session = $shopping_session;
            if(auth()->check()){
                $cart->customer_id = Auth::id();
            }
            $cart->total = $request->price_cents;
            $cart->save();   
            setcookie('shopping_session', $shopping_session, time() + (86400 * 7), "/"); 
            // Cart Item
            $cart_item = new CartItem();
            $cart_item->cart_id = $cart->id;
            $cart_item->quantity = 0;
            if($request->variation_name == '' && $request->variation_value == ''){
                $cart_item->variation_name = $request->variation_name;
                $cart_item->variation_value = $request->variation_value;
            }
            $cart_item->save();
            $a = 'Not set';
        }
        elseif( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $cart = Cart::where('shopping_session', $shopping_session)->first();
            if(!empty($cart)){
                if(auth()->check()){
                    $cart->customer_id = Auth::id();
                }
                if(!empty($cart->total)){ 
                    $db_total = $cart->total;
                    $cart->total = $db_total + $request->price_cents;
                }
                if(empty($cart->total)){
                    $cart->total = $request->price_cents;
                }
                $cart->save();
            }
            $product_id = $request->product_id;
            $cart_item = CartItem::where('product_id', $product_id)->first();
            if(!empty($cart_item)){
                $cart_item->cart_id = $cart->id;
                $cart_item->quantity++;
                if($request->variation_name == '' && $request->variation_value == ''){
                    $cart_item->variation_name = $request->variation_name;
                    $cart_item->variation_value = $request->variation_value;
                }
                $cart_item->save();
            } 
            elseif(empty($cart_item)){
                $cart_item = new CartItem();
                $cart_item->product_id = $request->product_id;
                $cart_item->cart_id = $cart->id;
                $cart_item->quantity = 1;
                if($request->variation_name == '' && $request->variation_value == ''){
                    $cart_item->variation_name = $request->variation_name;
                    $cart_item->variation_value = $request->variation_value;
                }
                $cart_item->save();
            }
            $a = "Is set";
        
        } else{
            return false;
        } 

        $notification = [
            'message' => $request->price_cents,
            'alert-type' => 'success'
        ];

        return response()->json($a . " : " .$request->price_cents  . ' : ' . $request->product_id);
        //return redirect()->route('admin.products')->with($notification);
    }

    
}
