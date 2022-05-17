<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $data['products'] = Product::with('categories')->get();
        return view('backend.products.index', $data);
    }

    public function add(Request $request){
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        return view('backend.products.add', $data);
    }
}
