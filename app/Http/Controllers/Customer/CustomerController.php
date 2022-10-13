<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $data['customers'] = User::where('role_id', 4)
                                    ->orderBy('updated_at', 'desc')
                                    ->paginate(15);
        $data['results'] = NULL;
        $data['search'] = NULL;
        return view('backend.customer.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $data['results'] = User::where('role_id', 4)
                                    ->where('name', 'LIKE', '%' . $search . '%')
                                    ->orderBy('updated_at', 'desc')
                                    ->paginate(15);
        $data['customers'] = NULL;
        $data['search'] = $search;
        return view('backend.customer.index', $data);
    }

    public function view($id){
        $data['customer'] = User::find($id);
        $data['orders'] = Order::where('customer_id', $id)->orderBy('created_at', 'desc')->get();
        return view('backend.customer.view', $data);
    }

    public function edit($id){
        $data['customer'] = User::find($id);
        return view('backend.customer.edit', $data);
    }

    public function update(Request $request, $id){
        $customer = User::find($id);
        $customer->name = $request->customer_name;
        $customer->first_name = $request->customer_first_name;
        $customer->last_name = $request->customer_last_name;
        $customer->email = $request->customer_email;
        $customer->phone_number = $request->customer_phone_number;
        $customer->address = $request->customer_address;
        $customer->delivery_address = $request->customer_delivery_address;
        $customer->city = $request->customer_city;
        $customer->company_name = $request->customer_company_name;
        $customer->date_of_birth = $request->customer_date_of_birth;
        $customer->gender = $request->customer_gender;
        $customer->id_number = $request->customer_id_number;
        $customer->role_id = 4; // Role Id for Customer     
        $customer->updated_at = now();      
        if( $request->file('customer_image') ){
            $customer_image = $request->file('customer_image');
            $image_extension = strtolower($customer_image->getClientOriginalExtension());
            $image_name = hexdec(uniqid()) . '.' . $image_extension;
            $upload_location = 'storage/users/customers/images/';
            if($customer->image){
                if(file_exists(public_path($upload_location . $customer->image))){
                    unlink($upload_location . $customer->image);
                }
                $customer_image->move($upload_location, $image_name);
                $customer->image = $image_name;                     
            }else{
                $customer_image->move($upload_location, $image_name);
                $customer->image = $image_name;
            }        
        }
        $customer->save();

        $notification = [
            'message' => 'Customer Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.customer')->with($notification);
    }
}
