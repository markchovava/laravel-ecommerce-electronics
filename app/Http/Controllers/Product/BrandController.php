<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $data['brands'] = Brand::all();
        return view('backend.brand.index', $data);
    }

    public function add(){
        return view('backend.brand.add');
    }

    public function store(Request $request){
        $brand = new Brand();
        $brand->name = $request->brand_name;
        if( $request->file('brand_image') ){
            $brand_image = $request->file('brand_image');
            $image_extension = strtolower($brand_image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/products/brand/';
            $brand_image->move($upload_location, $image_name);
            if($brand->image){
                unlink( $upload_location . $brand->image );
            }  
            $brand->image = $image_name;     
        }
        $brand->save();

        $notification = [
            'message' => 'Brand Added Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.brand')->with($notification);
    }

    public function edit($id){
        $data['brand'] = Brand::where('id',$id)->first();
        return view('backend.brand.edit', $data);
    }

    public function update(Request $request, $id){
        $brand = Brand::find($id);
        $brand->name = $request->brand_name;
        if( $request->file('brand_image') ){
            $brand_image = $request->file('brand_image');
            $image_extension = strtolower($brand_image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/products/brand/';
            $brand_image->move($upload_location, $image_name);
            if($brand->image){
                unlink( $upload_location . $brand->image );
            }  
            $brand->image = $image_name;     
        }
        $brand->save();

        $notification = [
            'message' => 'Brand Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.brand')->with($notification);
    }

    public function delete($id){
        $brand = Brand::find($id);
        $brand->delete();
        $notification = [
            'message' => 'Brand Deleted Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.brand')->with($notification);
    }

    public function search(){}
}
