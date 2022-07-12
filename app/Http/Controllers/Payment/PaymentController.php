<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Models\Payment\PaymentDetail;
use Paynow\Payments\Paynow;

class PaymentController extends Controller
{
    public function index(){
        
        /* 
        *   Role Management
        */
        $data['role_id'] = CheckRoles::check_role();
        
        if( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            if( !empty($data['cart']) ){
                $cart_quantity = $data['cart']->cart_items->sum('quantity');
            } else{
                $cart_quantity = 0; 
            }
            $data['cart_quantity'] = (!empty($cart_quantity)) ? $cart_quantity : '';
        }
        elseif( !(isset($_COOKIE['shopping_session'])) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }

        $paynow = new Paynow(
            env('PAYNOW_KEY'),
            env('PAYNOW_ID'),
            'http://lunartechstore.co.zw/track/order',

            // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
            'http://lunartechstore.co.zw/track/order'
        ); 

        # $paynow->setResultUrl('');
        # $paynow->setReturnUrl('');
        $reference_id = Session::get('reference_id');
        $email = Session::get('email');
        $total = 1.25;
       
        $payment = $paynow->createPayment($reference_id, $email);
       
        $payment->add('Lunartechstore Products', $total);
      
      
        //$payment = $paynow->createPayment('Invoice 35', 'markchovava@gmail.com');

        //$payment->add('Sadza and Beans', 1.25);

        $response = $paynow->send($payment);
        // Initiate a Payment 
        //$response = $paynow->send($payment);
        //dd($response);
        if(!$response->success){
            $result = $response->error;
        }
        else{
            $result = $response;
        }

        $data['pay'] = $payment->total;
        $data['result'] = $result;
        $data['response'] = $response;

        /* 
            * Add Payment Detials
            */
           /*  $pay = new PaymentDetail();
            $pay->order_id = $order->id; 
            $pay->amount = $order->total; 
            $pay->zwl_amount = $order->zwl_total; 
            $pay->currency = $order->currency; 
            $pay->method = $order->payment_method; 
            //$pay->status = $status; 
            $pay->poll_url = $pollUrl; 
            $pay->created_at = now();
            $pay->save(); */
        return view('frontend.pages.payment.index', $data);
    }



}
