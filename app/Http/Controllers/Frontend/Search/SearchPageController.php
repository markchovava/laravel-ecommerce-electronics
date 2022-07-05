<?php

namespace App\Http\Controllers\Frontend\Search;

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

class SearchPageController extends Controller
{
   public function search(Request $request){
        $data['role_id'] = CheckRoles::check_role();
        if( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
            } 
        }
        elseif( !(isset($_COOKIE['shopping_session'])) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }
        /* 
        *   Search Results
        */
        $name = $request->product_name;
        $results = false;
        if( !empty($name) ){
            $search = Product::where('name', 'LIKE', '%'. $name .'%')->get(); 
            if( !empty($search) && sizeof($search) != 0 ){
                $results = $search;
            } else{
                $results = false;
            }
        }else{
            $results = false;
        }
       $data['results'] = $results;
        
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
        
        return view('frontend.pages.search.index', $data);
   }
}
