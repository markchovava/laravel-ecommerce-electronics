<?php

namespace App\Http\Controllers\Frontend\Privacy;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Http\Controllers\Controller;
use App\Models\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PrivacyPageController extends Controller
{
    public function index(){
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        /*  IP Address */
        $ip_address = $this->ip();
        if( isset($shopping_session) || isset($ip_address) ){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
                //dd($data['cart_quantity']);
            } 
        }
        elseif( !(isset($shopping_session)) || !(isset($ip_address)) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }
        



        return view('frontend.pages.privacy', $data);
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
