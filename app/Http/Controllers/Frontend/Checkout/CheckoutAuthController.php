<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product\Brand;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\Tag\Tag;
use App\Models\Quote\CustomerQuote;
use App\Models\User;

class CheckoutAuthController extends Controller
{
    
    public function login(){
       
       /*   Check Roles    */
       $data['role_id'] = CheckRoles::check_role();
       /*  Check Cookie */
       $shopping_session = Cookie::get('shopping_session');
       $quote_session = Cookie::get('quote_session');
       /*  IP Address */
       $ip_address = $this->ip();
       /* Shopping Cart */
       if( isset($shopping_session) || isset($ip_address) ){
           $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
           if( !empty($data['cart']) ){
               $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
           } 
       }
       elseif( !(isset($shopping_session)) || !isset($ip_address) ){
           $data['cart'] = NULL;
           $data['cart_quantity'] = 0;
       }
       /* Shopping Quote */
       if( isset($quote_session) || isset($ip_address) ){
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
       
        /*  */
        if( Auth::check() ){
            return redirect()->route('checkout');
        }
        else{
            if( isset($shopping_session) || isset($ip_address) ){
            
                $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
                if( !empty($data['cart']) ){
                    $data['cart_quantity'] = isset($data['cart']->cart_items) ? $data['cart']->cart_items->sum('quantity') : NULL;
                    $cart_id =  $data['cart']->id;
                    $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();

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
                    return view('frontend.pages.checkout.login', $data);
                } else{
                    $data['cart_quantity'] = 0;
                    $data['message'] = "The Shopping Cart is empty at the moment.";

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
                    /* Categories */
                    $footer_categories = Category::orderBy('updated_at', 'desc')->paginate(6);
                    $data['footer_categories'] = (!empty($footer_categories)) ? $footer_categories : NULL;
                    /* Tags */
                    $footer_tags = Tag::orderBy('updated_at', 'desc')->paginate(6);
                    $data['footer_tags'] = (!empty($footer_tags)) ? $footer_tags : NULL;
                    /* Brands */
                    $footer_brands = Brand::orderBy('updated_at', 'desc')->paginate(6);
                    $data['footer_brands'] = (!empty($footer_brands)) ? $footer_brands : NULL;

                    return view('frontend.pages.checkout.login', $data);
                } 
            } 
            else{
                $data['cart_quantity'] = 0;
                $data['message'] = "The Shopping Cart is empty at the moment.";

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
                    /* Categories */
                    $footer_categories = Category::orderBy('updated_at', 'desc')->paginate(6);
                    $data['footer_categories'] = (!empty($footer_categories)) ? $footer_categories : NULL;
                    /* Tags */
                    $footer_tags = Tag::orderBy('updated_at', 'desc')->paginate(6);
                    $data['footer_tags'] = (!empty($footer_tags)) ? $footer_tags : NULL;
                    /* Brands */
                    $footer_brands = Brand::orderBy('updated_at', 'desc')->paginate(6);
                    $data['footer_brands'] = (!empty($footer_brands)) ? $footer_brands : NULL;

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
                'message' => 'Login failed...',
                'alert-type' => 'success'
            ];
            return redirect()->route('checkout.login')->with($notification);
        }
    }

    public function register(){
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        $quote_session = Cookie::get('quote_session');
        /*  IP Address */
        $ip_address = $this->ip();
        /* Shopping Cart */
        if( isset($shopping_session) || isset($ip_address) ){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
            } 
        }
        elseif( !(isset($shopping_session)) || !isset($ip_address) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }
        /* Shopping Quote */
        if( isset($quote_session) || isset($ip_address) ){
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
        /* Categories */
        $footer_categories = Category::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_categories'] = (!empty($footer_categories)) ? $footer_categories : NULL;
        /* Tags */
        $footer_tags = Tag::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_tags'] = (!empty($footer_tags)) ? $footer_tags : NULL;
        /* Brands */
        $footer_brands = Brand::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_brands'] = (!empty($footer_brands)) ? $footer_brands : NULL;

        /* 
        *   Check if user is logged in 
        */
        if( Auth::check() ){
            return redirect()->route('checkout'); 
        } 
        else{
            if( isset($shopping_session) || isset($ip_address) ){
                $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
                if( !empty($data['cart']) ){
                    $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
                    $cart_id =  $data['cart']->id;
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
        $user->name = $request->name;
        $user->email = $request->email;
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
