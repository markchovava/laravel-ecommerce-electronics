<?php

namespace App\Http\Controllers\Frontend\Tag;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Product\Tag\Tag;
use App\Models\Backend\BasicInfo;
use App\Models\Cart\Cart;
use App\Models\Product\Brand;
use App\Models\Quote\CustomerQuote;
use Illuminate\Support\Facades\Cookie;

class TagPageController extends Controller
{
    public function index()
    {
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        $quote_session = Cookie::get('quote_session');
        /*  IP Address */
        $ip_address = $this->ip();
        /* Shopping Cart */
        if( isset($shopping_session) || isset($ip_address) ){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
            } 
        }
        elseif( !(isset($shopping_session)) || !isset($ip_address) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }
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


        /* 
        * 
        *   All Available tags 
        * 
        */
        $data['tags'] = Tag::orderBy('click_name', 'asc')->get();
        /* 
        *   Sidebar Nav
        * 
        *   All Tags Names
        */
        $data['all_tags_names'] = Tag::with('products')->latest()->get();
        /* 
        *   All Tags
        */
        $data['all_categories_names'] = Category::with('products')->latest()->get();
        /* Brands */
        $data['brands'] = Brand::latest()->paginate(10);
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

        return view('frontend.pages.tag.index', $data);
    
    }

    public function view($id)
    {
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        $quote_session = Cookie::get('quote_session');
        /*  IP Address */
        $ip_address = $this->ip();
        /* Shopping Cart */
        if( isset($shopping_session) || isset($ip_address) ){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
            } 
        }
        elseif( !(isset($shopping_session)) || !isset($ip_address) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }
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


        $data['tag_name'] = Tag::find($id);
        $data['tags'] = Product::with('categories')->whereHas('tags', function($query) use($id){
            $query->where('product_tags.tag_id', $id); //this refers id field from categories table
        })
        ->orderBy('id','desc')
        ->paginate(12);

        /* 
        * 
        *   Sidebar Nav
        * 
        *   All Category
        */
        $data['all_tags_names'] = Tag::with('products')->latest()->get();
        /* 
        *   All Tags
        */
        $data['all_categories_names'] = Category::with('products')->latest()->get();

        /* Brands */
        $data['brands'] = Brand::latest()->paginate(10);
   
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

        return view('frontend.pages.tag.view', $data);
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
