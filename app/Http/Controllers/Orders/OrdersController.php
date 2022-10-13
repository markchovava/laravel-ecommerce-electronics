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
use App\Models\Miscellaneous\Miscellaneous;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Payment\PaymentDetail;
use App\Models\Product\Product;
use App\Models\Quote\CustomerQuote;
use App\Models\Shipping\Shipping;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function track()
    {
         /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        $quote_session = Cookie::get('quote_session');
        /*  IP Address */
        $ip_address = $this->ip();
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

        if( isset($shopping_session) || isset($ip_address) ){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
            //$cart_quantity = $data['cart']->cart_items->sum('quantity');
            //$data['cart_quantity'] = isset($cart_quantity) ? $cart_quantity : '';
            $data['cart_quantity'] = 0;
            //$cart_id =  $data['cart']->id;
            $cart_id =  0;
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
        $data['orders'] = Order::with(['customers', 'order_items'])
        ->orderBy('updated_at', 'desc')->paginate(15);;
        return view('backend.orders.index', $data);
    }

    public function search(Request $request){
        $reference_id = $request->reference_id;
        $data['results'] = Order::with(['customers', 'order_items'])->where('reference_id', $reference_id)->get();
        return view('backend.orders.index', $data);
    }

    public function view($id){
        $data['order'] = Order::with(['customers', 'order_items'])->where('id', $id)->first();
        $data['order_items'] = OrderItem::with(['product'])->where('order_id', $id)->get();
        return view('backend.orders.view', $data);
    }

    public function edit($id){
        $data['order'] = Order::with(['customers', 'order_items'])->where('id', $id)->first();
        $data['order_items'] = OrderItem::where('order_id', $id)->get();
        $data['payment'] = PaymentDetail::where('order_id', $id)->first();
        $data['currency'] = Miscellaneous::where('name', 'ZWL')->first();
        $data['shipping'] = Shipping::where('city', 'Harare')->first();
        // dd($data['currency']);
        return view('backend.orders.edit', $data);
    }

    public function update(Request $request, $id){
        DB::transaction(function() use($request, $id){
            /* Insert User */
            $customer_id = $request->customer_id;
            //dd($customer_id);
            $user = User::find($customer_id);
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
            $order = Order::find($id);
            $order->customer_id = $customer_id;            
            $order->reference_id = $request->reference_id;
            $order->subtotal = $request->cart_subtotal;
            $order->currency = $request->currency;
            $order->delivery = $request->delivery;
            $order->status = $request->status;
            $order->include_shipping = $request->include_shipping;
            $order->shipping_fee = (isset($request->include_shipping)) ? $request->shipping_fee : NULL;
            $order->subtotal = $request->total_usdCents;
            $order->zwl_subtotal = $request->total_zwlCents;
            /* Calculating Total */
            $order->total = intval($order->subtotal) + intval($order->shipping_fee);
            $order->zwl_total = $order->total * intval($request->currency_zwl_rate);
            $order->notes = $request->notes;
            $order->updated_at = now();
            $order->save();
            /*
            *   Adds Order Items 
            */
            if($request->product_id){
                $order_items = OrderItem::where('order_id', $order->id)->delete();
                $product_id = count($request->product_id);
                for($i = 0; $i < $product_id; $i++){
                    $order_items = new OrderItem();
                    //dd($request->product_name[$i]);
                    $order_items->product_name = $request->product_name[$i];
                    $order_items->order_id = $order->id;
                    $order_items->product_id = $request->product_id[$i];
                    // dd($request->product_quantity[$i]);
                    $order_items->quantity = isset($request->product_quantity[$i]) ? $request->product_quantity[$i] : NULL;
                    $order_items->unit_price = $request->product_unit_price[$i];
                    $order_items->zwl_unit_price = $request->product_zwl_unit_price[$i];
                    $order_items->product_variation = ( isset($request->product_variation[$i]) ) ? $request->product_variation[$i] : NULL;
                    $order_items->product_total = $request->product_total[$i];
                    $order_items->product_zwl_total = $request->product_zwl_total[$i];
                    $order_items->save();
                }
            }
        });

        $notification = [
            'message' => 'Updated Successfully!!...',
            'alert-type' => 'success'
        ];

         return redirect()->route('admin.orders')->with($notification);
    }

    public function search_product(Request $request){
        $product_name = $request->name;
        $data['product'] = Product::with(['inventories', 'discounts'])->where('name', 'LIKE', '%' . $product_name . '%')->get();
        return response()->json($data);
    }

    public function order_email(){

    }

    public function delete($id){
        $order = Order::find($id);
        $order->delete();
        OrderItem::where('order_id', $order->id)->delete();

        $notification = [
            'message' => 'Deleted Successfully!!...',
            'alert-type' => 'danger'
        ];
        return redirect()->route('admin.orders')->with($notification);
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
