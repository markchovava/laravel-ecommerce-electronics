<?php

namespace App\Http\Controllers\Frontend;

/* Custom Function call */
use App\Actions\RoleManagement\CheckRoles;

use App\Http\Controllers\Controller;
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
use App\Models\Product\Tag;
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

class HomeController extends Controller
{

    public function index()
    {
        /* Role Management */
        /* if(Auth::check()){
            $id = Auth::id();
            $user = User::where('id', $id)->first();
            $data['role_id'] = $user->role_id;
        } */
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

        $data['top_sticker'] = Sticker::where('slug', 'test')->first();

        $data['latest_products'] = Product::whereHas('categories', function($query){
            $query->where('slug', 'latest'); //this refers id field from categories table
        })
        ->orderBy('id','desc')
        ->get();
        $data['promotion_products'] = Product::whereHas('categories', function($query){
            $query->where('slug', 'promotion'); //this refers id field from categories table
        })
        ->orderBy('id','desc')
        ->get();
        $data['hot_products'] = Product::whereHas('categories', function($query){
            $query->where('slug', 'LIKE', '%hot-deals%'); //this refers id field from categories table
        })
        ->orderBy('id','desc')
        ->get();
        $data['trending_products'] = Product::whereHas('categories', function($query){
            $query->where('slug', 'LIKE', '%trending%'); //this refers id field from categories table
        })
        ->orderBy('id','desc')
        ->get();
       /*  $data['trending_products'] = Product::whereHas('categories', function($query){
            $query->where('name', 'Latest'); //this refers id field from categories table
        })
        Product::where('name', 'LIKE', '%' . $name . '%')->get();
        ->orderBy('id','desc')
        ->get(); */
        // $data['trending_products'] = Category::with('products')->where('slug', 'latest')->get();
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
