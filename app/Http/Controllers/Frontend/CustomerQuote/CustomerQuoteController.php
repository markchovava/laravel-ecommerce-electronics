<?php

namespace App\Http\Controllers\Frontend\CustomerQuote;

use App\Libraries\Fpdf\FPDF;
use App\Actions\RoleManagement\CheckRoles;
use App\Http\Controllers\Controller;
use App\Models\Backend\BasicInfo;
use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Miscellaneous\Miscellaneous;
use App\Models\Product\Brand;
use App\Models\Product\Category;
use App\Models\Product\Tag\Tag;
use App\Models\Quote\CustomerQuote;
use App\Models\Quote\CustomerQuoteItem;
use App\Models\Quote\Quote;
use App\Models\Shipping\Shipping;
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
        $quote = CustomerQuote::with('customer_quote_items')
                                ->where('quote_session', $quote_session)
                                ->orWhere('ip_address', $ip_address)
                                ->first();
        if( isset($quote) ){
            if( Auth::check() ){
                $quote->customer_id = Auth::id();
            }
            /* Adds Quantity into the DB */
            if(isset($request->quantity)){
                $quote->quantity = (int)$request->quantity;
            } else{
                $quote->quantity += 1;
            }
            $quote->save();
            $item = CustomerQuoteItem::with('product')->where('product_id', $request->product_id)
                                                ->where('customer_quote_id', $quote->id)->first();
            if( isset($item) ){
                /* Adds Quantity into the DB */
                $item->quantity += isset($request->quantity) ? (int)$request->quantity : 1;
                $item->usd_cents = $request->price_cents;
                $item->save();
            } 
            elseif( !isset($item) ){
                $item = new CustomerQuoteItem();
                $item->product_id = $request->product_id;
                $item->customer_quote_id = $quote->id;
                /* Adds Quantity into the DB */
                $item->quantity += isset($request->quantity) ? (int)$request->quantity : 1;
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
                $quote->customer_id = Auth::id();
            }
            /* Adds Quantity into the DB */
            $quote->quantity += isset($request->quantity) ? (int)$request->quantity : 1;
            $quote->save();
            //
            Cookie::queue('quote_session', $quote_session, 10080);
            //
            $item = CustomerQuoteItem::with('product')->where('product_id', $request->product_id)
                                                ->where('customer_quote_id', $quote->id)->first();
            if( isset($item) ){
                $item->product_name = $item->product->name;
                /* Adds Quantity into the DB */
                $item->quantity += isset($request->quantity) ? (int)$request->quantity : 1;
                $item->usd_cents = $request->price_cents;
                $item->save();
            } elseif( !isset($item) ){
                $item = new CustomerQuoteItem();
                $item->product_id = $request->product_id;
                $item->customer_quote_id = $quote->id;
                /* Adds Quantity into the DB */
                $item->quantity += isset($request->quantity) ? (int)$request->quantity : 1;
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
            $quote = CustomerQuote::with('customer_quote_items')
                                    ->where('quote_session', $quote_session)
                                    ->orWhere('ip_address', $ip_address)
                                    ->first();
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

    public function index(){
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        $quote_session = Cookie::get('quote_session');
        /*  IP Address */
        $ip_address = $this->ip();
        /* Shopping Cart */
        if( isset($shopping_session) || $ip_address){
            $data['cart'] = Cart::with('cart_items')
                                    ->where('shopping_session', $shopping_session)
                                    ->orWhere('ip_address', $ip_address)
                                    ->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
                //dd($data['cart_quantity']);
            } 
        }
        elseif( !(isset($shopping_session)) || !isset($ip_address) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }
        /* Shopping Quote */
        if( isset($quote_session) || $ip_address){
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

        /* Shopping Quote */
        if( isset($quote_session) || isset($ip_address)){
            $quote = CustomerQuote::with('customer_quote_items')->where('quote_session', $quote_session)
                                                    ->orWhere('ip_address', $ip_address)->first();
            $data['quote'] = $quote;
            if( isset($data['quote']) ){
                $data['quote_quantity'] = $data['quote']->customer_quote_items->sum('quantity');
                $quote_id = $data['quote']->id;
                $data['items'] = CustomerQuoteItem::with('product')->where('customer_quote_id', $quote_id)->get();
                /* 
                *   Shipping Fee 
                */
                $data['shipping'] = Shipping::first();
                /*
                *   ZWL Currency Value 
                */
                $data['currency'] = Miscellaneous::where('name', 'ZWL')->first();
                /* 
                *  Main Web Info 
                */
                $data['info'] = BasicInfo::first();
                /* Categories */
                $footer_categories = Category::orderBy('updated_at', 'desc')->paginate(6);
                $data['footer_categories'] = (!empty($footer_categories)) ? $footer_categories : NULL;
                /* Tags */
                $footer_tags = Tag::orderBy('updated_at', 'desc')->paginate(6);
                $data['footer_tags'] = (!empty($footer_tags)) ? $footer_tags : NULL;
                /* Brands */
                $footer_brands = Brand::orderBy('updated_at', 'desc')->paginate(6);
                $data['footer_brands'] = (!empty($footer_brands)) ? $footer_brands : NULL;
                /*  */
                return view('frontend.pages.quote.index', $data);
            } else{
                $data['cart_quantity'] = 0;
                $data['message'] = "The Shopping Cart is empty at the moment.";
                /* 
                *   Shipping Fee 
                */
                $data['shipping'] = Shipping::first();
                /*
                *   ZWL Currency Value 
                */
                $data['currency'] = Miscellaneous::where('name', 'ZWL')->first();
                /* 
                *  Main Web Info 
                */
                $data['info'] = BasicInfo::first();
                /* Categories */
                $footer_categories = Category::orderBy('updated_at', 'desc')->paginate(6);
                $data['footer_categories'] = (!empty($footer_categories)) ? $footer_categories : NULL;
                /* Tags */
                $footer_tags = Tag::orderBy('updated_at', 'desc')->paginate(6);
                $data['footer_tags'] = (!empty($footer_tags)) ? $footer_tags : NULL;
                /* Brands */
                $footer_brands = Brand::orderBy('updated_at', 'desc')->paginate(6);
                $data['footer_brands'] = (!empty($footer_brands)) ? $footer_brands : NULL;
                
                return view('frontend.pages.quote.index', $data);
            }           
        } 
        //dd('Here');
        //$data['cart_quantity'] = 0;
        $data['message'] = "The Shopping Quote is empty at the moment.";
        /* 
        *   Shipping Fee 
        */
        $data['shipping'] = Shipping::first();
        /*
        *   ZWL Currency Value 
        */
        $data['currency'] = Miscellaneous::where('name', 'ZWL')->first();
        /* 
        *  Main Web Info 
        */
        $data['info'] = BasicInfo::first();
        /* Categories */
        $footer_categories = Category::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_categories'] = (!empty($footer_categories)) ? $footer_categories : NULL;
        /* Tags */
        $footer_tags = Tag::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_tags'] = (!empty($footer_tags)) ? $footer_tags : NULL;
        /* Brands */
        $footer_brands = Brand::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_brands'] = (!empty($footer_brands)) ? $footer_brands : NULL;
        
        /* Return Page */
        return view('frontend.pages.quote.index', $data);     
    }

    public function store(Request $request){
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $quote_session = Cookie::get('quote_session');
        /*  IP Address */
        $ip_address = $this->ip();
       /* Auth Id */
        //dd($customer_id);
        
       if( !(Auth::check()) ){
            if( isset($quote_session) || isset($ip_address) ){
                $quote = CustomerQuote::with('customer_quote_items')
                                    ->where('quote_session', $quote_session)
                                    ->orWhere('ip_address', $ip_address)
                                    ->first();
                if( isset($quote) ){
                    $quote->shipping_fee = $request->shipping_feeCents;
                    $quote->quote_subtotal = $request->quote_subtotalCents;
                    $quote->grandtotal = $request->quote_totalCents;
                    $quote->zwl_grandtotal = $request->quote_zwltotalCents;
                    $quote->save();
                    $customer_quote_id = $quote->id;
                    $old_quote_items = CustomerQuoteItem::where('customer_quote_id', $customer_quote_id)->delete();
                    $product_id = $request->product_id;
                    if(isset($product_id)){
                        $count_id = count($request->product_id);
                        for($i = 0; $i < $count_id; $i++){
                            $items = new CustomerQuoteItem();
                            $items->customer_quote_id = $customer_quote_id;
                            $items->quantity = $request->product_quantity[$i];
                            $items->product_id = $request->product_id[$i];
                            if($request->product_variation != ''){
                                $items->product_variation = $request->product_variation;
                            }
                            $items->save();
                        }
            
                        return redirect()->route('customer.quote.checkout.login');
                    }

                }
            }else if( !isset($quote_session) && !isset($ip_address)){
                $quote_session = $this->randomString(30);
                // SET COOKIE
                Cookie::queue('quote_session', $quote_session, 10080);
                $quote = new CustomerQuote();
                $quote->quote_session = $quote_session;
                $quote->ip_address = $ip_address;
                $quote->shipping_fee = $request->shipping_feeCents;
                $quote->quote_subtotal = $request->quote_subtotalCents;
                $quote->grandtotal = $request->quote_totalCents;
                $quote->zwl_grandtotal = $request->quote_zwltotalCents;
                $quote->save();
                $customer_quote_id = $quote->id;
                $old_quote_items = CustomerQuoteItem::where('customer_quote_id', $customer_quote_id)->delete();
                $product_id = $request->product_id;
                if(isset($product_id)){
                    $count_id = count($request->product_id);
                    for($i = 0; $i < $count_id; $i++){
                        $items = new CustomerQuoteItem();
                        $items->customer_quote_id = $customer_quote_id;
                        $items->quantity = $request->product_quantity[$i];
                        $items->product_id = $request->product_id[$i];
                        if($request->product_variation != ''){
                            $items->product_variation = $request->product_variation;
                        }
                        $items->save();
                    }
                }
                return redirect()->route('customer.quote.checkout.login');  
            }
            return redirect()->route('customer.quote.checkout.login');
       }
       else{
           $customer_id = Auth::id();
           if( isset($quote_session) || isset($ip_address) ){
                $quote = CustomerQuote::with('customer_quote_items')
                                    ->where('quote_session', $quote_session)
                                    ->orWhere('ip_address', $ip_address)
                                    ->first();
                $quote->customer_id = $customer_id;
                $quote->shipping_fee = $request->shipping_feeCents;
                $quote->quote_subtotal = $request->quote_subtotalCents;
                $quote->grandtotal = $request->quote_totalCents;
                $quote->zwl_grandtotal = $request->quote_zwltotalCents;
                $quote->save();
                $customer_quote_id = $quote->id;
                $old_quote_items = CustomerQuoteItem::where('customer_quote_id', $customer_quote_id)->delete();
                $product_id = $request->product_id;
                if(isset($product_id)){
                   $count_id = count($request->product_id);
                   for($i = 0; $i < $count_id; $i++){
                       $items = new CustomerQuoteItem();
                       $items->customer_quote_id = $customer_quote_id;
                       $items->quantity = $request->product_quantity[$i];
                       $items->product_id = $request->product_id[$i];
                       if($request->product_variation != ''){
                           $items->product_variation = $request->product_variation;
                       }
                       $items->save();
                   }
        
                   return redirect()->route('customer.quote.checkout'); 
                }
           }
           elseif( !(isset($quote_session)) || !isset($ip_address) ){
               $notification = [
                   'message' => 'You need Products in the Cart to Generate PDF.',
                   'alert-type' => 'danger'
               ];
               
                return redirect()->route('index')->with($notification);
           }
       }
   }


  


   public function delete($id){
        $data['item'] = CustomerQuoteItem::find($id);
        $data['item']->delete();
        return response()->json('Deleted Successfully!...');
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
