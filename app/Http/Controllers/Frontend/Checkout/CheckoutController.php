<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(){
        if( Auth::check() ){
            if( isset($_COOKIE['shopping_session']) ){
                $shopping_session = $_COOKIE['shopping_session'];
                $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
                if( !empty($data['carts']) ){
                    $data['quantity'] = $data['carts']->cart_items->sum('quantity');
                    $cart_id =  $data['carts']->id;
                    $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
                    return view('frontend.pages.checkout.checkout',$data);
                } else{
                    $data['message'] = "The Shopping Cart is empty at the moment.";
                    return view('frontend.pages.checkout.checkout',$data);
                } 
            } 
            else{
                $data['message'] = "The Shopping Cart is empty at the moment.";
                return view('frontend.pages.checkout.checkout',$data);
            }
        }
        return redirect()->route('checkout.login');
    }

    public function login(){
        if( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            if( !empty($data['carts']) ){
                $data['quantity'] = $data['carts']->cart_items->sum('quantity');
                $cart_id =  $data['carts']->id;
                $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
                return view('frontend.pages.checkout.login', $data);
            } else{
                $data['message'] = "The Shopping Cart is empty at the moment.";
                return view('frontend.pages.checkout.login', $data);
            } 
        } 
        else{
            $data['message'] = "The Shopping Cart is empty at the moment.";
            return view('frontend.pages.checkout.login', $data);
        } 
    }

    public function login_process(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $notification = [
                'message' => 'Login Successfully!!...',
                'alert-type' => 'success'
            ];
            return redirect()->route('checkout')->with($notification);
        }else{
            $notification = [
                'message' => 'Please login first...',
                'alert-type' => 'success'
            ];
            return redirect()->route('checkout.login')->with($notification);
        }
    }

    public function register(){
        if( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            if( !empty($data['carts']) ){
                $data['quantity'] = $data['carts']->cart_items->sum('quantity');
                $cart_id =  $data['carts']->id;
                $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
                return view('frontend.pages.checkout.register', $data);
            } else{
                $data['message'] = "The Shopping Cart is empty at the moment.";
                return view('frontend.pages.checkout.register', $data);
            } 
        } 
        else{
            $data['message'] = "The Shopping Cart is empty at the moment.";
            return view('frontend.pages.checkout.register', $data);
        } 
    }

    public function register_process(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $notification = [
            'message' => 'Registration Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('checkout.login')->with($notification);
    }


}
