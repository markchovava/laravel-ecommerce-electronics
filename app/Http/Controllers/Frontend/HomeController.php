<?php

namespace App\Http\Controllers\Frontend;

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
use App\Models\User;
use App\Models\Cart\CartItem;
use App\Models\Sticker\Sticker;
use App\Models\Backend\BasicInfo;

class HomeController extends Controller
{

    public function index()
    {
        /* Role Management */
        
        $data['role_id'] = CheckRoles::check_role();
        
        if( isset($_COOKIE['shopping_session']) ){
            $shopping_session = $_COOKIE['shopping_session'];
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
            } else{
                $data['cart_quantity'] = 0; 
            }
        }
        elseif( !(isset($_COOKIE['shopping_session'])) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }

        /* Single Tags */
        $data['tag_first'] = Tag::where('position', 'First')->first();
        $data['tag_second'] = Tag::where('position', 'Second')->first();
        $data['tag_third'] = Tag::where('position', 'Third')->first();
        $data['tag_forth'] = Tag::where('position', 'Forth')->first();
        $data['tag_fifth'] = Tag::where('position', 'Fifth')->first();
        $data['tag_sixth'] = Tag::where('position', 'Sixth')->first();

        /* Single Category */
        $data['category_first'] = Category::with('products')->where('position', 'First')->first();
        $data['category_second'] = Category::with('products')->where('position', 'Second')->first();
        $data['category_third'] = Category::with('products')->where('position', 'Third')->first();
        $data['category_forth'] = Category::with('products')->where('position', 'Forth')->first();
        $data['category_fifth'] = Category::with('products')->where('position', 'Fifth')->first();
        $data['category_sixth'] = Category::with('products')->where('position', 'Sixth')->first();
        $data['category_seventh'] = Category::with('products')->where('position', 'Seventh')->first();

        /* Special Offer */
        $data['special_offer'] = Product::with(['discounts', 'inventories'])->where('special_offer', 'Yes')->first();

        /* Advert Area */
        $data['ad_first'] = Ads::where('page', 'Home')->where('position', 'First')->first();
        $data['ad_second'] = Ads::where('page', 'Home')->where('position', 'Second')->first();

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
        *   Website Basic Info
        */
        $data['info'] = BasicInfo::first();


        $data['latest_products'] = Product::with('categories')->whereHas('categories', function($query){
            $query->where('slug', 'latest'); //this refers id field from categories table
        })
        ->orderBy('id','desc')
        ->paginate(8);
        $data['promotion_products'] = Product::with('categories')->whereHas('categories', function($query){
            $query->where('slug', 'promotion'); //this refers id field from categories table
        })
        ->orderBy('id','desc')
        ->paginate(8);
        $data['hot_products'] = Product::with('categories')->whereHas('categories', function($query){
            $query->where('slug', 'LIKE', '%hot-deals%'); //this refers id field from categories table
        })
        ->orderBy('id','desc')
        ->paginate(8);
        $data['trending_products'] = Product::with('categories')->whereHas('categories', function($query){
            $query->where('slug', 'LIKE', '%trending%'); //this refers id field from categories table
        })
        ->orderBy('id','desc')
        ->paginate(8);
       
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
}
