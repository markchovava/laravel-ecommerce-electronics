<?php

namespace App\Http\Controllers\Contact;

/*
*   Custom Function call 
*/
use App\Actions\RoleManagement\CheckRoles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart\Cart;
use App\Models\Product\Brand;
use App\Models\Backend\BasicInfo;
use App\Models\Message\Message;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Product\Tag\Tag;
use Illuminate\Support\Facades\Cookie;

class ContactPageController extends Controller
{
    public function index(){
       /* 
        *   Role Management
        */
        $data['role_id'] = CheckRoles::check_role();
        $shopping_session = Cookie::get('shopping_session');
        //dd($shopping_session);
        if( isset($shopping_session) ){
            $data['cart'] = Cart::with('cart_items')->where('shopping_session', $shopping_session)->first();
            if( !empty($data['cart']) ){
                $data['cart_quantity'] = $data['cart']->cart_items->sum('quantity');
                //dd($data['cart_quantity']);
            } 
        }
        elseif( !(isset($shopping_session)) ){
            $data['cart'] = NULL;
            $data['cart_quantity'] = 0;
        }

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
        *   Website Basic Info
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


        return view('frontend.pages.contact.index', $data);
    }

    public function store(Request $request){
        $message = new Message();
        $message->first_name = $request->first_name;
        $message->last_name = $request->last_name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->status = 'Unread';
        $message->type = 'Enquiry';
        $message->created_at = now();
        $message->updated_at = now();
        $message->save();

        $notification = [
            'message' => 'Message sent Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('contact.index')->with($notification);
    }
}
