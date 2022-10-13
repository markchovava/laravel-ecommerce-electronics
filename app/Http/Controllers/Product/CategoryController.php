<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data['categories'] = Category::orderBy('updated_at','desc')
                                        ->paginate(15);
        $data['results'] = NULL;
        $data['search'] = NULL;
        return view('backend.category.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = Category::where('name', 'LIKE', '%' . $search . '%')
                                ->orderBy('updated_at','desc')
                                ->paginate(15);
        $data['results'] = $results;
        $data['search'] = $search;
        $data['categories'] = NULL;
        return view('backend.category.index', $data);
    }

    public function add(){
        return view('backend.category.add');
    }

    public function store(Request $request){
        $category= new Category();
        $category->name = $request->category_name;
        $category->description = $request->category_description;
        $category->slug = $request->category_slug;
        $category->position = $request->category_position;
        $category->status = $request->category_status;
        $category->created_at = now();
        if( $request->file('category_image') )
        {
            $category_image = $request->file('category_image');
            $image_extension = strtolower($category_image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/products/category/';
            $category_image->move($upload_location, $image_name);
            if($category->image)
            {
                if(file_exists(public_path($upload_location . $category->image))){
                    //dd('file exists');
                    unlink( $upload_location . $category->image );
                }
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
    
    public function edit($id){
        $data['category'] = Category::find($id);
        return view('backend.category.edit', $data);
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        $category->name = $request->category_name;
        $category->description = $request->category_description;
        $category->status = $request->category_status;
        $category->position = $request->category_position;
        $category->slug = $request->category_slug;
        $category->updated_at = now();
        if( $request->file('category_image') ){
            $category_image = $request->file('category_image');
            $image_extension = strtolower($category_image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/products/category/';
            $category_image->move($upload_location, $image_name);
            if($category->image){
                if(file_exists(public_path($upload_location . $category->image))){
                    unlink( $upload_location . $category->image );
                }
            }  
            $category->image = $image_name;     
        }
        $category->save();

        $notification = [
            'message' => 'Category Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.category')->with($notification);
    }
    
    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        $notification = [
            'message' => 'Category Deleted Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.category')->with($notification);
    }
}
