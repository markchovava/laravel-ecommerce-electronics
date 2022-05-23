<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data['categories'] = Category::with('products')->get();
        return view('backend.category.index', $data);
    }

    public function add(){
        return view('backend.category.add');
    }

    public function store(Request $request){
        $category= new Category();
        $category->name = $request->category_name;
        $category->description = $request->category_description;
        $category->status = $request->category_status;

        if( $request->file('category_thumbnail') )
        {
            $category_thumbnail = $request->file('category_thumbnail');
            $image_extension = strtolower($category_thumbnail->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/products/category/';
            $category_thumbnail->move($upload_location, $image_name);
            if($category->image)
            {
                unlink( $upload_location . $category->image );
            }  
            $category->image = $image_name;     
        }
        $category->save();

        $notification = [
            'message' => 'Catergory Added Successfully!!...',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.category')->with($notification);
    }
    
    public function edit(){}
    public function update(){}
    public function delet(){}
    public function search(){}
}
