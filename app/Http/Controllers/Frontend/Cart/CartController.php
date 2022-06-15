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
            elseif( empty($cart) ){
                $cart = new Cart();
                $cart->shopping_session = $_COOKIE['shopping_session'];
                if(auth()->check()){
                    $cart->customer_id = Auth::id();
                }
                if( !empty($cart->total) ){ 
                    $db_total = $cart->total;
                    $cart->total = $db_total + $request->price_cents;
                }
                if( empty($cart->total) ){
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
        return redirect()->route('cart.view');      
    }

    public function store(Request $request){
        if( !(Auth::check()) ){
            return redirect()->route('login');
        }
        else{
            if( isset($_COOKIE['shopping_session']) ){
                $shopping_session = $_COOKIE['shopping_session'];
                $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
                $data['cart']->customer_id = Auth::id();
                $data['cart']->shipping_fee = $request->shipping_feeCents;
                $data['cart']->cart_subtotal = $request->cart_subtotalCents;
                $data['cart']->total = $request->cart_totalCents;
                $data['cart']->save();
                $cart_id = $data['cart']->id;
                $old_cart_items = CartItem::where('cart_id', $cart_id)->delete();
                $product_id = $request->product_id;
                if($product_id){
                    $count_id = count($request->product_id);
                    for($i = 0; $i < $count_id; $i++){
                        $cart_items = new CartItem();
                        $cart_items->cart_id = $cart_id;
                        $cart_items->quantity = $request->product_quantity[$i];
                        //dd($cart_items->quantity);
                        $cart_items->product_id = $request->product_id[$i];
                        if($request->variation_name != '' && $request->variation_value != ''){
                            $cart_items->variation_name = $request->variation_name[$i];
                            $cart_items->variation_value = $request->variation_value[$i];
                        }
                        $cart_items->save();
                    }
                    return redirect()->route('checkout'); 
                }
            }
            elseif( !(isset($_COOKIE['shopping_session'])) ){
                $notification = [
                    'message' => 'You need Products in the Cart to Proceed to Checkout.',
                    'alert-type' => 'danger'
                ];
                return redirect()->route('index')->with($notification);
            }
        }
    }

    public function view(){
        if( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            if(!empty($data['cart'])){
                $data['quantity'] = $data['cart']->cart_items->sum('quantity');
            }      
        }
        elseif( !(isset($_COOKIE['shopping_session'])) ){
            $data['cart'] = NULL;
            $data['quantity'] = 0;
        }
        return response()->json($data);
    }

    public function index(){
        if( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            if( !empty($data['carts']) ){
                $data['quantity'] = $data['carts']->cart_items->sum('quantity');
            } 
            $cart_id =  $data['carts']->id;
            $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
            // dd($data['cart_items']);
            return view('frontend.pages.cart', $data);
        } 
            return redirect()->back();     
    }

    public function delete($id){
        $data['cart_item'] = CartItem::find($id);
        $data['cart_item']->delete();
        return response()->json('Deleted Successfully!...');
    }
}
