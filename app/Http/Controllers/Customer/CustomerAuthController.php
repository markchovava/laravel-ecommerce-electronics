<?php

namespace App\Http\Controllers\Customer;

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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CustomerAuthController extends Controller
{
    public function login(){
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        /*  IP Address */
        $ip_address = $this->ip();

        if( isset($shopping_session) || isset($ip_address) ){
            $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)
                                    ->orWhere('ip_address', $ip_address)->first();
            $cart_quantity = $data['carts']->cart_items->sum('quantity');
            $data['cart_quantity'] = isset($cart_quantity) ? $data['carts']->cart_items->sum('quantity') : 0;
            $cart_id =  $data['carts']->id;
            $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
            return view('frontend.pages.customer.login',$data);     
        } 
        $data['cart_quantity'] = 0;
        return view('frontend.pages.customer.login',$data);
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
            return redirect()->route('index')->with($notification);
        }else{
            $notification = [
                'message' => 'Please login first...',
                'alert-type' => 'success'
            ];
            return redirect()->route('customer.login')->with($notification);
        }
    }

    public function register(){
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        /*  IP Address */
        $ip_address = $this->ip();
        if( Auth::check() ){
            return redirect()->route('index'); 
        } 
        if( isset($shopping_session) || isset($ip_address) ){
            $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)
                            ->orWhere('ip_address', $ip_address)->first();
            $data['cart_quantity'] = $data['carts']->cart_items->sum('quantity');
            $cart_id =  $data['carts']->id;
            $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
            return view('frontend.pages.customer.register',$data);     
        } 
        $data['cart_quantity'] = 0;
        return view('frontend.pages.customer.register',$data);
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
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = 4; // For Customer
        $user->password = Hash::make($request->password);
        $user->save();

        $notification = [
            'message' => 'Registration Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('customer.login')->with($notification);
    }

    /* The sign out is used by Customer and also Checkout */
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('index');
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
