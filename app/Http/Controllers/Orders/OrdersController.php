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
use App\Models\Product\Product;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function track()
    {
        $data['role_id'] = CheckRoles::check_role();
        if( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            $data['cart_quantity'] = $data['carts']->cart_items->sum('quantity');
            $cart_id =  $data['carts']->id;
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

    public function order_email(){

    }
}
