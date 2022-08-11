<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Payments\Paynow;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Miscellaneous\Miscellaneous;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Payment\PaymentDetail;
use App\Models\Product\Brand;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\Tag\Tag;
use App\Models\Quote\CustomerQuote;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function index(){

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

        
        if( Auth::check() ){
            /* 
            *   Auth user ID
            */
            $user_id = Auth::id();
            $data['user'] = User::where('id', $user_id)->first();
            if( isset($shopping_session) || isset($ip_address) ){
                $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
                if( !empty($data['cart']) ){
                    $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
                    $cart_id =  $data['cart']->id;
                    $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
                    /* Currency Convertion */
                    $data['zwl_currency'] = Miscellaneous::where('name', 'ZWL')->first();

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

                    return view('frontend.pages.checkout.checkout',$data);
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

                    return view('frontend.pages.checkout.checkout',$data);
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

                return view('frontend.pages.checkout.checkout',$data);
            }
        }

        
        return redirect()->route('checkout.login');
    }

    /* 
    *   Custom Function for generating Random Numbers  
    */
    public function reference_id(){
        $date = date('dhis');
        $rand = rand(0, 100);
        return 'ORDER' . $date. $rand;
    }

    public function checkout_process(Request $request){
         /*   Check Roles    */
         $data['role_id'] = CheckRoles::check_role();
         /*  Check Cookie */
         $shopping_session = Cookie::get('shopping_session');
         /*  IP Address */
         $ip_address = $this->ip();
         /*   User Id   */
         $customer_id = Auth::user()->id;
        $shopping_session = Cookie::get('shopping_session');
        $payment_session = $this->randomString(40);
        Cookie::queue('payment_session', $payment_session, 10080);

        if( Auth::check() ){
            /* Insert User */
            $id = Auth::id();
            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->delivery_address = $request->delivery_address;
            $user->city = $request->city;
            $user->company_name = $request->company_name;
            $user->company_phone_number = $request->company_phone_number;
            $user->company_email = $request->company_email;
            $user->company_address = $request->company_address;
            $user->company_city = $request->company_city;
            $user->company_name = $request->company_name;
            $user->role_id = isset($user->role_id) ? $user->role_id : 4;
            $user->save();      
           
            /*
            *   Adds an Order 
            */
            $order = new Order();
            $order->customer_id = $user->id;            
            $order->reference_id = $this->reference_id();
            $order->subtotal = $request->cart_subtotal;
            $order->shipping_fee = $request->shipping_fee;
            $order->total = $request->cart_total;
            $order->zwl_total = $request->cart_zwltotal;
            $order->status = 'Processing';
            $order->notes = $request->notes;
            $order->created_at = now();
            $order->updated_at = now();
            $order->delivery = (isset($request->to_company_address)) ? "To Company Address" : "To Delivery Address";
            $order->save();
            /*
            *   Adds Order Items 
            */
            if($request->product_id){
                $product_id = count($request->product_id);
                for($i = 0; $i < $product_id; $i++){
                    $order_items = new OrderItem();
                    $order_items->product_name = $request->product_name[$i];
                    $order_items->order_id = $order->id;
                    $order_items->product_id = $request->product_id[$i];
                    $order_items->quantity = $request->product_quantity[$i];
                    $order_items->unit_price = $request->product_unit_price[$i];
                    $order_items->product_variation = ( isset($request->product_variation[$i]) ) ? $request->product_variation[$i] : NULL;
                    $order_items->product_total = $request->product_total[$i];
                    $order_items->product_zwl_total = $request->product_zwl_total[$i];
                    $order_items->save();
                }
            }
            
            /* 
            * Add Payment Detials
            */
            $pay = new PaymentDetail();
            $pay->order_id = $order->id; 
            $pay->reference_id = $order->reference_id; 
            $pay->customer_id = $order->customer_id; 
            $pay->amount = $request->total_payamount; 
            $pay->zwl_amount = $request->total_payzwlamount;  
            $pay->method = $request->payment_method; 
            $pay->status = 'Submitted to Paynow'; 
            $pay->currency = $request->currency; 
            $pay->payment_session = $payment_session; 
            //$pay->status = $status; 
            //$pay->poll_url = $pollUrl; 
            $pay->created_at = now();
            $pay->updated_at = now();
            $pay->save();

            
            Session::put('order_id', $order->id );
            Session::put('reference_id', $order->reference_id );
            Session::put('email', $user->email );
            Session::put('total', $pay->amount );
            Session::put('zwl_total', $pay->zwl_amount );
            Session::put('payment_method', $pay->method );
            Session::put('currency', $pay->currency );


             /* Delete Cart And Cart Items */
             if(isset($shopping_session) || isset($ip_address)){
                $cart = Cart::where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
                $cart_id = $cart->id;
                $cart_items = CartItem::where('cart_id', $cart_id)->delete();
                $cart = Cart::where('shopping_session', $shopping_session)->delete();
                Cookie::queue(Cookie::forget('shopping_session'));
                unset($shopping_session );
                setcookie('shopping_session','', time() - 3600);
            }

            
            $notification = [
                'message' => 'The Order has been processed.',
                'alert-type' => 'success'
            ];
            return redirect()->route('payment.index');    
        } else{
            return redirect()->route('customer.login');
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
