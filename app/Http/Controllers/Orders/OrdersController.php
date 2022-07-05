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
            return view('frontend.pages.orders.track',$data);     
        } 
        $data['cart_quantity'] = 0;

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
}
