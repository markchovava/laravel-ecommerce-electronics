<?php

namespace App\Http\Controllers\Frontend;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Ads\Ads;
use App\Models\UserProduct;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductMeta;
use App\Models\Product\ProductTag;
use App\Models\Product\ProductBrand;
use App\Models\Product\Tag\Tag;
use App\Models\Product\Tax;
use App\Models\Product\Brand;
use App\Models\Product\CategoryProduct;
use App\Models\Product\Discount;
use App\Models\Product\Inventory;
use App\Models\Product\Variation;
use App\Models\Cart\Cart;
use App\Models\User;
use App\Models\Cart\CartItem;
use App\Models\Sticker\Sticker;
use App\Models\Backend\BasicInfo;
use App\Models\Quote\CustomerQuote;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
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
        *   Single Tags 
        */
        $tag_first = Tag::where('position', 'First')->first();
        $data['tag_first'] = (!empty($tag_first)) ? $tag_first : NULL;
        $tag_second = Tag::where('position', 'Second')->first();
        $data['tag_second'] = (!empty($tag_second)) ? $tag_second : NULL;
        $tag_third = Tag::where('position', 'Third')->first();
        $data['tag_third'] = (!empty($tag_third)) ? $tag_third : NULL;
        $tag_forth = Tag::where('position', 'Forth')->first();
        $data['tag_forth'] = (!empty($tag_forth)) ? $tag_forth : NULL;
        $tag_fifth = Tag::where('position', 'Fifth')->first();
        $data['tag_fifth'] = (!empty($tag_fifth)) ? $tag_fifth : NULL;
        $tag_sixth = Tag::where('position', 'Sixth')->first();
        $data['tag_sixth'] = (!empty($tag_sixth)) ? $tag_sixth : NULL;

        /* 
        *   Single Category 
        */
        $category_first = Category::with('products')->where('position', 'First')->first();
        $data['category_first'] = (!empty($category_first)) ? $category_first : NULL;
        //dd($data['category_first']);
        $category_second = Category::with('products')->where('position', 'Second')->first();
        $data['category_second'] = (!empty($category_second)) ? $category_second : NULL;
        //dd($data['category_second']);
        $category_third = Category::with('products')->where('position', 'Third')->first();
        $data['category_third'] = (!empty($category_third)) ? $category_third : NULL;
        //dd($data['category_third']);
        $category_forth = Category::with('products')->where('position', 'Forth')->first();
        $data['category_forth'] = (!empty($category_forth)) ? $category_forth : NULL;
        //dd($data['category_forth']);
        $category_fifth = Category::with('products')->where('position', 'Fifth')->first();
        $data['category_fifth'] = (!empty($category_fifth)) ? $category_fifth : NULL;
        // dd($data['category_fifth']);
        $category_sixth = Category::with('products')->where('position', 'Sixth')->first();
        $data['category_sixth'] = (!empty($category_sixth)) ? $category_sixth : NULL;
        //dd($data['category_sixth']);
       /*  $category_seventh = Category::with('products')->where('position', 'Seventh')->first();
        $data['category_seventh'] = (!empty($category_seventh)) ? $category_seventh : NULL; */
        // dd($data['category_seventh']); // Is null
        $category_eighth = Category::with('products')->where('position', 'Eighth')->first();
        $data['category_eighth'] = (!empty($category_eighth)) ? $category_eighth : NULL;
        //dd($data['category_eighth']);

        /*
        *   Special Offer 
        */
        $special_offer = Product::with(['discounts', 'inventories'])->where('special_offer', 'Yes')->first();
        $data['special_offer'] = (!empty($special_offer)) ?  $special_offer : NULL;
        //dd($data['special_offer']);

        /* 
        *   Advert Area 
        */
        $ad_first = Ads::where('page', 'Home')->where('position', 'First')->first();
        $data['ad_first'] = (!empty($ad_first)) ? $ad_first : NULL;
        //dd($data['ad_first']);
        $ad_second = Ads::where('page', 'Home')->where('position', 'Second')->first();
        $data['ad_second'] = (!empty($ad_second)) ? $ad_second : NULL;
        //dd($data['ad_second']);

        /*  
        *   Brands 
        */
        $brands = Brand::latest()->paginate(10);
        $data['brands'] = (!empty($brands)) ? $brands : NULL;
        //dd($data['brands']);

        /* 
        *   Footer Products 
        *   3 First Tag, Trending Products 
        */
        $tag_first_three = Product::whereHas('tags', function($query){
            $query->where('position', 'First'); //this refers id field from categories table
        })->orderBy('updated_at','desc')->paginate(3);
        $data['tag_first_three'] = (!empty($tag_first_three))  ? $tag_first_three : NULL;
        //dd($data['tag_first_three'] );
        /* 
        *   3 Latest Products 
        */
        $latest_three = Product::latest()->orderBy('updated_at','desc')->paginate(3);
        $data['latest_three'] = (!empty($latest_three))  ? $latest_three : NULL;
        //dd($data['latest_three']);
        /* 
        *  3 Daily Hot Products 
        */
        $tag_second_three = Product::whereHas('tags', function($query){
            $query->where('position', 'Second'); //this refers id field from categories table
        })->orderBy('updated_at','desc')->paginate(3);
        $data['tag_second_three'] = (!empty($tag_second_three))  ? $tag_second_three : NULL;
        //dd($data['tag_second_three']);
        

        /* 
        *   Website Basic Info
        */
        $info = BasicInfo::first();
        $data['info'] = (!empty($info)) ? $info : Null;


        /* 
        *   Tag Latest
        */
        $tag_latest = Tag::where('slug', 'LIKE', '%latest%')->first();
        $data['tag_latest'] = (!empty($tag_latest)) ? $tag_latest : Null;
        $latest_products = Product::with('tags')->whereHas('tags', function($query){
            $query->where('tags.slug', 'LIKE', '%latest%'); //this refers slug field from tags table
        })->orderBy('id','desc')->paginate(12);
        $data['latest_products'] = (!empty($latest_products)) ? $latest_products : Null;

         /* 
        *   Tag Promotion
        */
        $tag_promotion = Tag::where('slug', 'LIKE', '%promotion%')->first();
        $data['tag_promotion'] = (!empty($tag_promotion)) ? $tag_promotion : NULL ;
        $promotion_products = Product::with(['tags','categories'])->whereHas('tags', function($query){
            $query->where('tags.slug', 'LIKE', '%promotion%'); //this refers slug field from tags table
        })->orderBy('id','desc')->paginate(12);
        $data['promotion_products'] = (!empty($promotion_products)) ? $promotion_products : NULL ;

        /* 
        *   Tag Hot Deals
        */
        $tag_hot_deal = Tag::where('slug', 'LIKE', '%%hot-deals%%')->first();
        $data['tag_hot_deal'] = (!empty($tag_hot_deal)) ? $tag_hot_deal : NULL;
        $hot_deals = Product::with(['tags','categories'])->whereHas('tags', function($query){
            $query->where('tags.slug', 'LIKE', '%hot-deals%'); //this refers slug field from tags table
        })->orderBy('id','desc')->paginate(12);
        $data['hot_deals'] = (!empty($hot_deals)) ? $hot_deals : NULL;

        /* 
        *   Tag Trending Products
        */
        $tag_trending = Tag::where('slug', 'LIKE', '%trending%')->first();
        $data['tag_trending'] = (!empty($tag_trending)) ? $tag_trending : NULL;
        $trending_products = Product::with(['tags','categories'])->whereHas('tags', function($query){
            $query->where('tags.slug', 'LIKE', '%trending%'); //this refers slug field from tags table
        })->orderBy('id','desc')->paginate(12);
        $data['trending_products'] = (!empty($trending_products)) ? $trending_products : NULL;
       
        /* Categories */
        $footer_categories = Category::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_categories'] = (!empty($footer_categories)) ? $footer_categories : NULL;
        /* Tags */
        $footer_tags = Tag::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_tags'] = (!empty($footer_tags)) ? $footer_tags : NULL;
        /* Brands */
        $footer_brands = Brand::orderBy('updated_at', 'desc')->paginate(6);
        $data['footer_brands'] = (!empty($footer_brands)) ? $footer_brands : NULL;

        $data['products'] = Product::with([
            'categories',
            'brands',
            'product_metas',
            'discounts',
            'inventories',
            'taxes',
            'tags',
            'variations',
            ])->get();

        return view('frontend.pages.index', $data);
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
