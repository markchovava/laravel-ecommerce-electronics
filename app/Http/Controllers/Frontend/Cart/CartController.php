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
    
    public function store(Request $request){
        DB::transaction(function() use($request){
            
            if(isset($_COOKIE['shopping_session'])){
                $session_id = $_COOKIE['shopping_session'];
                $cart = Cart::where('shopping_session', $session_id)->first();
                if(!empty($cart)){
                    if(auth()->check()){
                        $cart->customer_id = Auth::id();
                    }
                    if(!empty($cart->total)){
                        $db_total = $cart->total;
                        $cart->total = $db_total + $request->total;
                    }
                    $cart->save();
                }
            }
            else{
                $cart = new Cart();
                $session_id = randomString(30);
                $cart->shopping_session = $session_id;
                if(auth()->check()){
                    $cart->customer_id = Auth::id();
                }
                $cart->total = $request->total;
                $cart->save();
            }
            
        });    
    }

    protected function randomString($length) {
        $keys = array_merge(range(0,9), range('a', 'z'));
        $key = "";
        for($i=0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }
}
