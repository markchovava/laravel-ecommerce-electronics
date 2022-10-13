<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::orderBy('name', 'ASC')
                                ->paginate(15);
        $data['brands'] = $brands;
        $data['search'] = NULL;
        $data['results'] = NULL;
        return view('backend.brand.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = Brand::where('name', 'LIKE', '%' . $search . '%')
                                        ->orderBy('name', 'ASC')
                                        ->paginate(15);
        $data['results'] = $results;
        $data['search'] = $search;
        $data['brands'] = NULL;
        return view('backend.brand.index', $data);
    }

    public function add(){
        return view('backend.brand.add');
    }

    public function store(Request $request){
        $brand = new Brand();
        $brand->created_at = $brand->updated_at = now();
        $brand->name = $request->brand_name;
        if( $request->file('brand_image') )
        {
            $brand_image = $request->file('brand_image');
            $image_extension = strtolower($brand_image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/products/brand/';
            if($brand->image){
                if(file_exists(public_path($upload_location . $brand->image))){
                    unlink($upload_location . $brand->image);
                }
                $brand_image->move($upload_location, $image_name);
                $brand->image = $image_name;                    
            }else{
                $brand_image->move($upload_location, $image_name);
                $brand->image = $image_name;
            }              
        }
        $brand->save();

        $notification = [
            'message' => 'Brand Added Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.brand')->with($notification);
    }

    public function edit($id){
        $data['brand'] = Brand::find($id);
        return view('backend.brand.edit', $data);
    }

    public function update(Request $request, $id){
        $brand = Brand::find($id);
        $brand->created_at = $brand->updated_at = now();
        $brand->name = $request->brand_name;
        if( $request->file('brand_image') ){
            $brand_image = $request->file('brand_image');
            $image_extension = strtolower($brand_image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/products/brand/';
            if($brand->image){
                if(file_exists(public_path($upload_location . $brand->image))){
                    unlink($upload_location . $brand->image);
                }
                $brand_image->move($upload_location, $image_name);
                $brand->image = $image_name;                    
            }else{
                $brand_image->move($upload_location, $image_name);
                $brand->image = $image_name;
            }              
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
        $upload_location = 'storage/products/brand/';
        if($brand->image){
            if(file_exists(public_path($upload_location . $brand->image))){
                unlink($upload_location . $brand->image);
            }
        }  
        $brand->delete();
        $notification = [
            'message' => 'Brand Deleted Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.brand')->with($notification);
    }

}
