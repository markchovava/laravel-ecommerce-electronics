<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Backend\BasicInfo;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Payment\PaymentDetail;
use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function track()
    {
         /*   Check Roles    */
         $data['role_id'] = CheckRoles::check_role();
         /*  Check Cookie */
         $shopping_session = Cookie::get('shopping_session');
         /*  IP Address */
         $ip_address = $this->ip();
        if( isset($shopping_session) || isset($ip_address) ){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
            $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
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

            return view('frontend.pages.orders.track',$data);     
        } 
        /* 
        *   Cart Quantity 
        */
        $data['cart_quantity'] = 0;
        /* 
        *   Check if Logged in. 
        */

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
        if( Auth::check() ){
            /* 
            *   Get the latest Order.
            */
            $data['order'] = Order::where('customer_id', Auth::id())->latest()->first();
        }
        
        /* 
        *   Basic Info 
        */
        $data['info'] = BasicInfo::first();
        return view('frontend.pages.orders.track', $data);
    }

    public function index(){
        $data['orders'] = Order::with(['customers', 'order_items'])->latest()->get();
        return view('backend.orders.index', $data);
    }

    public function view($id){
        $data['order'] = Order::with(['customers', 'order_items'])->where('id', $id)->first();
        $data['order_items'] = OrderItem::where('order_id', $id)->get();
        return view('backend.orders.view', $data);
    }

    public function edit($id){
        $data['order'] = Order::with(['customers', 'order_items'])->where('id', $id)->first();
        $data['order_items'] = OrderItem::where('order_id', $id)->get();
        $data['payment'] = PaymentDetail::where('order_id', $id)->first();
        return view('backend.orders.edit', $data);
    }

    public function update($id){
        $order = Order::find($id);
        $order->save();
        $customer = User::where('id', $order->customer_id)->first();
    }

    public function order_email(){

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
