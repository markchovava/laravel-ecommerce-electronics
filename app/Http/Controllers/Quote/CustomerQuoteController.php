<?php

namespace App\Http\Controllers\Quote;

use App\Http\Controllers\Controller;
use App\Models\Quote\CustomerQuote;
use App\Models\Quote\CustomerQuoteItem;
use App\Models\Quote\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CustomerQuoteController extends Controller
{
    public function add(Request $request){
        // Get Ip
        $ip_address = $this->ip();
        // Get Cookie
        $quote_session = Cookie::get('quote_session');
        // Check if Ip and Cookie is in DB
        $quote = CustomerQuote::with('customer_quote_items')->where('quote_session', $quote_session)
                                                    ->orWhere('ip_address', $ip_address)->first();
        if( isset($quote) ){
            if( Auth::check() ){
                $quote->user_id = Auth::id();
            }
            $quote->quantity += 1;
            $quote->save();
            $item = CustomerQuoteItem::with('product')->where('product_id', $request->product_id)
                                                ->where('customer_quote_id', $quote->id)->first();
            if( isset($item) ){
                $item->quantity += 1;
                $item->usd_cents = $request->price_cents;
                $item->save();
            } elseif( !isset($item) ){
                $item = new CustomerQuoteItem();
                $item->product_id = $request->product_id;
                $item->customer_quote_id = $quote->id;
                $item->quantity = 1;
                $item->usd_cents = $request->price_cents;
                $item->save();
            }
        } elseif( !isset($quote) ){
            /* Random String */
            $quote_session = $this->randomString(30);
            $quote = new CustomerQuote();
            $quote->quote_session = $quote_session;
            $quote->ip_address = $ip_address;
            if( Auth::check() ){
                $quote->user_id = Auth::id();
            }
            $quote->quantity = 1;
            $quote->save();
            //
            Cookie::queue('quote_session', $quote_session, 10080);
            //
            $item = CustomerQuoteItem::with('product')->where('product_id', $request->product_id)
                                                ->where('customer_quote_id', $quote->id)->first();
            if( isset($item) ){
                $item->product_name = $item->product->name;
                $item->quantity += 1;
                $item->usd_cents = $request->price_cents;
                $item->save();
            } elseif( !isset($item) ){
                $item = new CustomerQuoteItem();
                $item->product_id = $request->product_id;
                $item->customer_quote_id = $quote->id;
                $item->quantity = 1;
                $item->usd_cents = $request->price_cents;
                $item->save();
            }
        }
        return redirect()->route('quote.view');  
    }

    public function view(){
        // Get Ip
        $ip_address = $this->ip();
        // Get Cookie
        $quote_session = Cookie::get('quote_session');
        // Check
        if( isset($quote_session) || isset($ip_address) ){
            // Check if Ip and Cookie is in DB
            $quote = CustomerQuote::with('customer_quote_items')->where('quote_session', $quote_session)
                                                        ->orWhere('ip_address', $ip_address)->first();
            $data['quote'] = $quote;
            if( isset($quote) ){
                $quantity = $quote->customer_quote_items->sum('quantity');
                $data['quantity'] = $quantity;
            } else{
                $data['quantity'] = 0;
            }    
        }
        elseif( !isset($quote_session) && !isset($ip_address) ){
            $data['quote']  = NULL;
            $data['quantity'] = 0;
        }
        return response()->json($data);
    }

    /* Generate Random String */
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
