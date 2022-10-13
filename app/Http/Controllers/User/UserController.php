<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::with('role')->where('id', '!=', Auth::id())
                                    ->orderBy('updated_at', 'desc')
                                    ->paginate(15);
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
        $user->role_id = intval($request->user_role_id);
        $code = rand(100000, 1000000);
        $user->code = $code;        
        $user->password = Hash::make($code);      
        $user->created_at = now();      
        if( $request->file('user_image') ){
            $user_image = $request->file('user_image');
            $image_extension = strtolower($user_image->getClientOriginalExtension());
            $image_name = hexdec(uniqid()) . '.' . $image_extension;
            $upload_location = 'storage/users/images/'; 
            if($user->image){
                unlink($upload_location . $user->image);
                $user_image->move($upload_location, $image_name);
                $user->image = $image_name;                    
            }else{
                $user_image->move($upload_location, $image_name);
                $user->image = $image_name;
            }        
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

    public function view($id){
        $data['user'] = User::find($id);
        return view('backend.users.view', $data);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->user_name;
        $user->first_name = $request->user_first_name;
        $user->last_name = $request->user_last_name;
        $user->email = $request->user_email;
        $user->phone_number = $request->user_phone_number;
        $user->address = $request->user_address;
        $user->date_of_birth = $request->user_date_of_birth;
        $user->gender = $request->user_gender;
        $user->id_number = $request->user_id_number;
        $user->role_id = intval($request->user_role_id);     
        /* $code = rand(100000, 1000000);
        $user->code = $code;        
        $user->password = Hash::make($code);  
        $code = rand(100000, 1000000);
        $user->code = $code;        
        $user->password = Hash::make($code);  */     
        $user->updated_at = now();      
        if( $request->file('user_image') ){
            $user_image = $request->file('user_image');
            $image_extension = strtolower($user_image->getClientOriginalExtension());
            $image_name = hexdec(uniqid()) . '.' . $image_extension;
            $upload_location = 'storage/users/images/';
            if($user->image){
                if(file_exists(public_path($upload_location . $user->image))){
                    unlink($upload_location . $user->image);
                }
                $user_image->move($upload_location, $image_name);
                $user->image = $image_name;                    
            }else{
                $user_image->move($upload_location, $image_name);
                $user->image = $image_name;
            }        
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
