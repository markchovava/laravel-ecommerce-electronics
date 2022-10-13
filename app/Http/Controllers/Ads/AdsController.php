<?php

namespace App\Http\Controllers\Ads;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Ads\Ads;
use App\Models\Ads\AdUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    public function index(){
        $data['ads'] = Ads::latest()->paginate(15);
        return view('backend.ads.index', $data);
    }

    public function add(){
        return view('backend.ads.add');
    }

    public function edit($id){
        $data['ad'] = Ads::where('id', $id)->orderBy('id', 'desc')->first();
        return view('backend.ads.edit', $data);
    }

    public function store(Request $request){
        DB::transaction(function() use($request){
            $ad = new Ads();
            $ad->title = $request->ad_title;
            $ad->page = $request->ad_page;
            $ad->click_name = $request->ad_click_name;
            $ad->percent = $request->ad_percent;
            $ad->link = $request->ad_link;
            $ad->price = $request->ad_price;
            $ad->status = $request->ad_status;
            $ad->position = $request->ad_position;
            $ad->description = $request->ad_description;
            $ad->created_at = now();
            if( !empty($request->file('ad_image')) ){
                $ad_image = $request->file('ad_image');
                $image_extension = strtolower($ad_image->getClientOriginalExtension());
                $image_name = date('YmdHi'). '.' . $image_extension;
                $upload_location = 'storage/images/ad/';
                $ad_image->move($upload_location, $image_name);
                if($ad->image){
                    if(file_exists(public_path($upload_location . $ad->image))){
                        unlink( $upload_location . $ad->image );
                    }
                }  
                $ad->image = $image_name;     
            }
            $ad->save();
            /* ::: Ad User Relationship ::: */
            $ad_user = new AdUser();
            $ad_user->user_id = Auth::id();
            $ad_user->ad_id = $ad->id;
            $ad_user->save();
        });
    
        $notification = [
            'message' => 'Adverts Added Successfully!!...',
            'alert-type' => 'success'
        ];   
        return redirect()->route('admin.ad')->with($notification);     
    }

    public function update(Request $request, $id){
        DB::transaction(function() use($request, $id){
            $ad = Ads::find($id);
            $ad->title = $request->ad_title;
            $ad->page = $request->ad_page;
            $ad->click_name = $request->ad_click_name;
            $ad->percent = $request->ad_percent;
            $ad->link = $request->ad_link;
            $ad->price = $request->ad_price;
            $ad->status = $request->ad_status;
            $ad->position = $request->ad_position;
            $ad->description = $request->ad_description;
            $ad->updated_at = now();
            if( !empty($request->file('ad_image')) ){
                $ad_image = $request->file('ad_image');
                $image_extension = strtolower($ad_image->getClientOriginalExtension());
                $image_name = date('YmdHi'). '.' . $image_extension;
                $upload_location = 'storage/images/ad/';
                $ad_image->move($upload_location, $image_name);
                if($ad->image){
                    if(file_exists(public_path($upload_location . $ad->image))){
                        unlink( $upload_location . $ad->image );
                    }
                }  
                $ad->image = $image_name;     
            }
            $ad->save();
            /* ::: Ad User Relationship ::: */
            $ad_user = AdUser::where('ad_id', $ad->id)->first();
            $the_id = $ad_user->id;
            $ad_user = AdUser::find($the_id);
            $ad_user->user_id = Auth::id();
            $ad_user->ad_id = $ad->id;
            $ad_user->save();
        });
        $notification = [
            'message' => 'Adverts Updated Successfully!!...',
            'alert-type' => 'success'
        ];   
        return redirect()->route('admin.ad')->with($notification);  
    }

    public function delete($id){
        DB::transaction(function() use($id){
            $ad = Ads::find($id);
            $ad->delete();
            AdUser::where('ad_id', $ad->id)->delete();
        });
        
        $notification = [
            'message' => 'Adverts Deleted Successfully!!...',
            'alert-type' => 'success'
        ];   
        return redirect()->route('admin.ad')->with($notification);
    }
}
