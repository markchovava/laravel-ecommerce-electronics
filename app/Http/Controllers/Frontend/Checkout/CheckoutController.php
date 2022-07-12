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
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Payment\PaymentDetail;
use App\Models\Product\Product;
use App\Models\User;
use Paynow\Payments\Paynow as PaymentsPaynow;

class CheckoutController extends Controller
{
    public function index(){
        if( Auth::check() ){
            $data['role_id'] = CheckRoles::check_role();
            /* 
            *   Auth user ID
            */
            $user_id = Auth::id();
            $data['user'] = User::where('id', $user_id)->first();
            if( isset($_COOKIE['shopping_session']) ){
                $shopping_session = $_COOKIE['shopping_session'];
                $data['carts'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
                if( !empty($data['carts']) ){
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
        if( Auth::check() ){
            /* Insert User */
            $id = Auth::id();
            $user = User::find($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->delivery_address = $request->delivery_address;
            $user->city = $request->city;
            $user->company_name = $request->company_name;
            $user->company_phone_number = $request->company_phone_number;
            $user->company_email = $request->company_email;
            $user->company_address = $request->company_address;
            $user->company_city = $request->company_city;
            $user->company_name = $request->company_name;
            if( $user->role_id == false){
                $user->role_id = 4;
            }
            $user->save();      
             
            /* 
            *   Pay NoW Integration 
            */
           /* $paynow = new PaymentsPaynow(
                    env('PAYNOW_KEY'),
                    env('PAYNOW_ID'),
                    'http://lunartechstore.co.zw/checkout',
                
                    // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
                    'http://lunartechstore.co.zw/track/order'
                );  
                
                # $paynow->setResultUrl('');
                # $paynow->setReturnUrl('');
                
                $payment = $paynow->createPayment($this->reference_id(), $user->email);
                $payment->add($this->reference_id(), 1.25);
                $response = $paynow->send($payment);
                
                if($response->success()) {
                    // Or if you prefer more control, get the link to redirect the user to, then use it as you see fit
                    $link = $response->redirectUrl();
                    $pollUrl = $response->pollUrl();
                    // Check the status of the transaction
                    $status = $paynow->pollTransaction($pollUrl);
                }  
            */
           
            /*
            *   Adds an Order 
            */
            $order = new Order();
            $order->customer_id = Auth::id();            
            $order->reference_id = $this->reference_id();
            $order->subtotal = $request->cart_subtotal;
            $order->shipping_fee = $request->shipping_fee;
            $order->total = $request->cart_total;
            $order->zwl_total = $request->cart_zwltotal;
            $order->status = 'Processing';
            $order->notes = $request->notes;
            $order->created_at = now();
            $order->updated_at = now();
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
            
            /* 
            * Add Payment Detials
            */
            $pay = new PaymentDetail();
            $pay->order_id = $order->id; 
            //$pay->amount = $order->total; 
            //$pay->zwl_amount = $order->zwl_total; 
            //$pay->currency = $order->currency; 
            $pay->method = $order->payment_method; 
            //$pay->status = $status; 
            //$pay->poll_url = $pollUrl; 
            $pay->created_at = now();
            $pay->save();

            Session::put('reference_id', $order->reference_id );
            Session::put('email', $user->email );
            Session::put('total', $order->total );
            Session::put('payment_method', $pay->method );

            $notification = [
                'message' => 'The Order has been processed.',
                'alert-type' => 'success'
            ];
            return redirect()->route('payment.index');    
        }
       
    }

}
