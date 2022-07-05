<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product\Product;
use App\Models\User;


class CheckoutController extends Controller
{
    public function index(){
        if( Auth::check() ){
            $data['role_id'] = CheckRoles::check_role();
            
            $user_id = Auth::id();
            $data['user'] = User::where('id', $user_id)->first();
            if( isset($_COOKIE['shopping_session']) ){
                $shopping_session = $_COOKIE['shopping_session'];
                $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
                if( !empty($data['carts']) ){
                    $data['cart_quantity'] = $data['carts']->cart_items->sum('quantity');
                    $cart_id =  $data['carts']->id;
                    $data['cart_items'] = CartItem::with('product')->where('cart_id', $cart_id)->get();
                    return view('frontend.pages.checkout.checkout',$data);
                } else{
                    $data['cart_quantity'] = 0;
                    $data['message'] = "The Shopping Cart is empty at the moment.";
                    return view('frontend.pages.checkout.checkout',$data);
                } 
            } 
            else{
                $data['cart_quantity'] = 0;
                $data['message'] = "The Shopping Cart is empty at the moment.";
                return view('frontend.pages.checkout.checkout',$data);
            }
        }
        return redirect()->route('checkout.login');
    }

    public function reference_id(){
        $date = date('dhis');
        $rand = rand(0, 100);
        return 'ORDER' . $date . '-' . $rand;
    }

    public function checkout_process(Request $request){
        if( Auth::check() ){
            /* Insert User */
            $id = Auth::id();
            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->company_name = $request->company_name;
            $user->company_phone_number = $request->company_phone_number;
            $user->company_email = $request->company_email;
            $user->company_address = $request->company_address;
            $user->company_city = $request->company_city;
            $user->company_name = $request->company_name;
            if( $user->user_type == false ){
                $user->user_type = 'Customer';
            }
            if( $user->role_id == false){
                $user->role_id = 4;
            }
            $user->save();      
            /*
            *   Adds an Order 
            */
            $order = new Order();
            $order->customer_id = Auth::id();            
            $order->reference_id = $this->reference_id();
            $order->subtotal = $request->cart_subtotal;
            $order->shipping_fee = $request->shipping_fee;
            $order->total = $request->cart_total;
            $order->status = 'Processing';
            $order->notes = $request->notes;
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
                    if($request->product_variation_name[$i] && $request->product_variation_value[$i]){
                        $order_items->product_variation = $request->product_variation_name[$i] + ' : ' 
                        + $request->product_variation_value[$i];
                    }
                    $order_items->product_total = $request->product_total[$i];
                    $order_items->save();
                }
            }
            /* Delete Cart And Cart Items */
            if(isset($_COOKIE['shopping_session'])){
                $shopping_session = $_COOKIE['shopping_session'];
                $cart = Cart::where('shopping_session', $shopping_session)->first();
                $cart_id = $cart->id;
                $cart_items = CartItem::where('cart_id', $cart_id)->delete();
                $cart = Cart::where('shopping_session', $shopping_session)->delete();
                unset($_COOKIE['shopping_session']);
                setcookie('shopping_session','', time() - 3600);
            }

            $notification = [
                'message' => 'The Order has been processed.',
                'alert-type' => 'success'
            ];
            return redirect()->route('order.track')->with($notification);    
        }
       
    }

}
