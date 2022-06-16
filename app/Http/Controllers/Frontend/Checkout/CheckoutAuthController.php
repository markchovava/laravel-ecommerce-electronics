<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class CheckoutAuthController extends Controller
{
    
    public function login(){
        if( Auth::check() ){
            return redirect()->route('checkout');
        }
        else{
            if( isset($_COOKIE['shopping_session']) ){
                /* Role Management */
                $data['role_id'] = CheckRoles::check_role();
                /* Check Shopping Session */
                $shopping_session = $_COOKIE['shopping_session'];
                $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
                if( !empty($data['carts']) ){
                    $data['cart_quantity'] = $data['carts']->cart_items->sum('quantity');
                    $cart_id =  $data['carts']->id;
                    $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
                    return view('frontend.pages.checkout.login', $data);
                } else{
                    $data['cart_quantity'] = 0;
                    $data['message'] = "The Shopping Cart is empty at the moment.";
                    return view('frontend.pages.checkout.login', $data);
                } 
            } 
            else{
                $data['cart_quantity'] = 0;
                $data['message'] = "The Shopping Cart is empty at the moment.";
                return view('frontend.pages.checkout.login', $data);
            } 
        }
    }

    public function login_process(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $remember = $request->has('remember') ? true : false;
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials, $remember)){
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
        $data['role_id'] = CheckRoles::check_role();
        if( Auth::check() ){
            return redirect()->route('checkout'); 
        } 
        else{
            if( isset($_COOKIE['shopping_session']) ){
                $shopping_session = $_COOKIE['shopping_session'];
                $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
                if( !empty($data['carts']) ){
                    $data['cart_quantity'] = $data['carts']->cart_items->sum('quantity');
                    $cart_id =  $data['carts']->id;
                    $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
                    return view('frontend.pages.checkout.register', $data);
                } else{
                    $data['cart_quantity'] = 0;
                    $data['message'] = "The Shopping Cart is empty at the moment.";
                    return view('frontend.pages.checkout.register', $data);
                } 
            } 
            else{
                $data['cart_quantity'] = 0;
                $data['message'] = "The Shopping Cart is empty at the moment.";
                return view('frontend.pages.checkout.register', $data);
            }     
        }    
    }

    public function register_process(Request $request){
        $data['role_id'] = CheckRoles::check_role();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->role = 'Customer';
        $user->role_id = 4;
        $user->password = Hash::make($request->password);
        $user->save();

        $notification = [
            'message' => 'Registration Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('checkout.login')->with($notification);
    }

    /* The sign out is used by Customer and also Checkout */
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('index');
    }

}
