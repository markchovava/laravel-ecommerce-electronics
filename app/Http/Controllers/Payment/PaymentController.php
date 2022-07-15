<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;
use App\Models\Cart\Cart;
use App\Models\Payment\PaymentDetail;
use App\Models\Payment\PaymentResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Paynow\Payments\Paynow;

class PaymentController extends Controller
{
    public function index(){
        
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        /*  IP Address */
        $ip_address = $this->ip();
        
        if( isset($shopping_session) || isset($ip_address)){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
            if( !empty($data['cart']) ){
                $cart_quantity = $data['cart']->cart_items->sum('quantity');
            } else{
                $cart_quantity = 0; 
            }
            $data['cart_quantity'] = (!empty($cart_quantity)) ? $cart_quantity : '';
        }
        elseif( !(isset($shopping_session)) || !isset($ip_address) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }
        
        $reference_id = Session::get('reference_id');
        $email = Session::get('email');
        $total = Session::get('total');
        $zwl_total = Session::get('zwl_total');
        $currency =  Session::get('currency');
        $payment_method = Session::get('payment_method');

        if($payment_method == 'Paynow'){

            $paynow = new Paynow(
                env('PAYNOW_KEY'),
                env('PAYNOW_ID'),
                'http://lunartechstore.co.zw/payment/update',
    
                // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
                'http://lunartechstore.co.zw/track/order'
            ); 
    
            # $paynow->setResultUrl('');
            # $paynow->setReturnUrl('');
            
           
            $payment = $paynow->createPayment($reference_id, $email); 
            $payment->add('Lunartechstore Online', $zwl_total);
            //$payment->add('Sadza and Beans', 2);
            //$payment = $paynow->createPayment('Invoice 35', 'markchovava@gmail.com');
            //$payment->add('Sadza and Beans', 1.25);
    
            // Initiate a Payment 
            $response = $paynow->send($payment);
            if(!$response->success){
                $result = $response->error;
            }
            else{
                $result = $response;
            }
            
            $data['pay'] = $payment->total;
            $data['result'] = $result;
            $data['response'] = $response;
            
    
            return view('frontend.pages.payment.index', $data);

        }

        
    }

    public function update(Request $request){
        $payment_session = Cookie::get('payment_session');
        $reference_id = Session::get('reference_id');

       
        if(Auth::check() ){

            $paynow = new Paynow(
                env('PAYNOW_KEY'),
                env('PAYNOW_ID'),
                'http://lunartechstore.co.zw/payment/update',
    
                // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
                'http://lunartechstore.co.zw/track/order'
            ); 
            $status = $paynow->processStatusUpdate();
            // Check if the transaction was paid
            if($status->paid()) {
                // Update transaction in DB maybe? 
                $status_reference = $status->reference();
                $reference =  isset($status_reference) ? $status_reference : null;
                // Get the reference of the Payment in paynow
                $status_paynowReference = $status->paynowReference();
                $paynowReference = isset($status_paynowReference) ? $status_paynowReference : NULL;
                // Log out the data
                //dummy_logger($status);
            }
            $pay = PaymentDetail::where('reference_id', $reference_id)->orWhere('payment_session', $payment_session)->first();
            if( isset($pay) ){
                $result = new PaymentResult();
                $result->details_id = $pay->id;
                $result->reference = $reference;
                $result->paynowreference = $paynowReference;
                $result->pollurl = $status;
                $result->status = $status;
                $result->save();
                if( isset($payment_session) ){
                    Cookie::queue(Cookie::forget('shopping_session'));
                    unset($shopping_session );
                    setcookie('shopping_session','', time() - 3600);
                }
                return redirect()->route('order.track');
            } 
        } else{
            return redirect()->route('index');
        }
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
