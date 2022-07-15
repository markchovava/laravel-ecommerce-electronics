<?php

namespace App\Http\Controllers\Frontend\Category;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Http\Controllers\Controller;
use App\Models\Ads\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
use App\Models\Cart\CartItem;
use App\Models\Backend\BasicInfo;
use Illuminate\Support\Facades\Cookie;

class CategoryPageController extends Controller
{
    public function index()
    {
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
        /*  
        *   All Available Category 
        */
        $data['categories'] = Category::orderBy('name', 'asc')->get();
        /* 
        *   Sidebar Nav
        * 
        *   All Tags Names
        */
        $data['all_categories_names'] = Category::with('products')->latest()->get();
        /* 
        *   All Tags
        */
        $data['all_tags_names'] = Tag::with('products')->latest()->get();
        /* 
        *   Brands 
        */
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

        return view('frontend.pages.category.index', $data);
    
    }
    
    public function view($id)
    {
        /*   Check Roles    */
        $data['role_id'] = CheckRoles::check_role();
        /*  Check Cookie */
        $shopping_session = Cookie::get('shopping_session');
        /*  IP Address */
        $ip_address = $this->ip();

        if( isset($shopping_session) ){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->orWhere('ip_address', $ip_address)->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
                //dd($data['cart_quantity']);
            } 
        }
        elseif( !(isset($shopping_session)) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }

        $data['category_name'] = Category::find($id);
        $data['category'] = Product::with('categories')->whereHas('categories', function($query) use($id){
            $query->where('product_categories.category_id', $id); //this refers id field from categories table
        })
        ->orderBy('id','desc')
        ->paginate(12);

        /* 
        * 
        *   Sidebar Nav
        * 
        */
        /* 
        *   All Category
        */
        $data['all_categories_names'] = Category::with('products')->latest()->get();
        /* 
        *   All Tags
        */
        $data['all_tags_names'] = Tag::with('products')->latest()->get();

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




        $data['info'] = BasicInfo::first();
        return view('frontend.pages.category.view', $data);
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
