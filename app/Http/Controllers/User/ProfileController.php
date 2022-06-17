<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class ProfileController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function view(){
        $id = Auth::user()->id;
        $data['profile'] = User::find($id);
        return view('backend.profile.view', $data);
    }
    public function edit(){
        $id = Auth::user()->id;
        $data['profile'] = User::find($id);
        return view('backend.profile.edit', $data);
    }
    public function update(Request $request){
        $id = Auth::user()->id;
        $profile = User::find($id);
        $profile->name = $request->user_name;
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->email = $request->user_email;
        $profile->phone_number = $request->phone_number;
        $profile->address = $request->user_address;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->gender = $request->user_gender;
        $profile->id_number = $request->user_id_number;
        $profile->role = $request->user_role;       
        /* $code = rand(100000, 1000000);
        $profile->code = $code;        
        $profile->password = Hash::make($code);  
        $code = rand(100000, 1000000);
        $profile->code = $code;        
        $profile->password = Hash::make($code);  */     
        $profile->updated_at = now();      
        if( $request->file('profile_image') ){
            $profile_image = $request->file('profile_image');
            $image_extension = strtolower($profile_image->getClientOriginalExtension());
            $image_name = hexdec(uniqid()) . '.' . $image_extension;
            $upload_location = 'storage/users/images/';
            if(!empty($profile->image)){
                unlink($upload_location . $profile->image);
                $profile_image->move($upload_location, $image_name);
                $profile->image = $image_name;                    
            }else{
                $profile_image->move($upload_location, $image_name);
                $profile->image = $image_name;
            }    
        }
        $profile->save();

        $notification = [
            'message' => 'User Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('profile.view')->with($notification);
    }
    public function passwordEdit(){
        $id = Auth::user()->id;
        $data['password'] = User::find($id);
        return view('backend.profile.password', $data);
    }
    public function passwordUpdate(Request $request){
        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]); 

        $id = Auth::user()->id;
        $profile = User::find($id);
        $hashedPassword = $profile->password;
        if( Hash::check($request->current_password, $hashedPassword) )
        {
            $profile->password = Hash::make($request->password);
            $profile->save();
            Auth::logout();
            return redirect()->route('login')->with('success', "Password Updated Successfully!!...");
        } else
        {
            return back();
        }
        
    }

}
