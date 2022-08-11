<?php

namespace App\Http\Controllers\Quote;

use App\Http\Controllers\Controller;
use App\Models\Quote\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CustomerQuoteController extends Controller
{
    public function add(Request $request){
        // Get Ip
        $ip_address = $this->ip();
        // Get Cookie
        $shopping_session = Cookie::get('shopping_session');
        // Check if Ip is in DB
        $quote = Quote::with('quote_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
        //if( $quote != false ){}
        // Check if Cookie is n DB

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
