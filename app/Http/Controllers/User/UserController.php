<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::where('role', '!=', 'Administrator')->get();
        return view('backend.users.index', $data); 
    }

    public function add(){
        $data['users'] = User::all();
        return view('backend.users.index', $data); 
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->role = $request->user_role;
        $code = rand(100000, 1000000);
        $user->code = $code;        
        $user->password = Hash::make($code);      
        $user->created_at = now();      
        if( $request->file('user_image') ){
            $user_image = $request->file('user_image');
            $image_extension = strtolower($user_image->getClientOriginalExtension());
            $image_name = hexdec(uniqid()) . '.' . $image_extension;
            $upload_location = 'storage/users/images/';
            $user_image->move($upload_location, $image_name);
            if($user->image){
                unlink( $upload_location . $user->image );
            }  
            $user->image = $image_name;     
        }
        $user->save();

        $notification = [
            'message' => 'User Added Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.users')->with($notification);
    }

    public function edit($id){
        $data['user'] = User::find($id);
        return view('backend.users.edit', $data);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->user_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->user_email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->user_address;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->user_gender;
        $user->id_number = $request->user_id_number;
        $user->role = $request->user_role;       
        $code = rand(100000, 1000000);
        $user->code = $code;        
        $user->password = Hash::make($code);  
        $code = rand(100000, 1000000);
        $user->code = $code;        
        $user->password = Hash::make($code);      
        $user->created_at = now();      
        if( $request->file('user_image') ){
            $user_image = $request->file('user_image');
            $image_extension = strtolower($user_image->getClientOriginalExtension());
            $image_name = hexdec(uniqid()) . '.' . $image_extension;
            $upload_location = 'storage/users/images/';
            $user_image->move($upload_location, $image_name);
            if($user->image){
                unlink( $upload_location . $user->image );
            }  
            $user->image = $image_name;     
        }
        $user->save();

        $notification = [
            'message' => 'User Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.users')->with($notification);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        $notification = [
            'message' => 'User Deleted Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.users')->with($notification);
    }

    public function search()
    {
        
    }

}
