<?php

namespace App\Http\Controllers\Pages\Home;

use App\Http\Controllers\Controller;
use App\Models\Sticker\Sticker;
use Illuminate\Http\Request;

class StickerController extends Controller
{
    public function index(){
        $data['stickers'] = Sticker::latest()->paginate(20);
        return view('backend.pages.home.sticker.index', $data);
    }

    public function add(){
        return view('backend.pages.home.sticker.add');
    }

    public function store(Request $request){
        $sticker = new Sticker();
        $sticker->title = $request->sticker_title;
        $sticker->subtitle = $request->sticker_subtitle;
        $sticker->click_name = $request->sticker_click_name;
        $sticker->amount = $request->sticker_amount;
        $sticker->slug = $request->sticker_slug;
        $sticker->status = $request->sticker_status;
        $sticker->created_at = now();
        if( $request->file('sticker_image') )
        {
            $sticker_thumbnail = $request->file('sticker_image');
            $image_extension = strtolower($sticker_thumbnail->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/pages/sticker/';
            $sticker_thumbnail->move($upload_location, $image_name);
            if($sticker->image)
            {
                unlink( $upload_location . $sticker->image );
            }  
            $sticker->image = $image_name;     
        }
        $sticker->save();

        $notification = [
            'message' => 'Sticker Added Successfully!!...',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.pages.home.sticker')->with($notification);
    }

    public function edit($id){
        $data['sticker'] = Sticker::find($id);
        return view('backend.pages.home.sticker.edit', $data);
    }

    public function update(Request $request, $id){
        $sticker = Sticker::find($id);
        $sticker->title = $request->sticker_title;
        $sticker->subtitle = $request->sticker_subtitle;
        $sticker->click_name = $request->sticker_click_name;
        $sticker->amount = $request->sticker_amount;
        $sticker->percent = $request->sticker_percent;
        $sticker->slug = $request->sticker_slug;
        $sticker->status = $request->sticker_status;
        $sticker->updated_at = now();
        if( $request->file('sticker_image') )
        {
            $sticker_thumbnail = $request->file('sticker_image');
            $image_extension = strtolower($sticker_thumbnail->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/pages/sticker/';
            $sticker_thumbnail->move($upload_location, $image_name);
            if($sticker->image)
            {
                unlink( $upload_location . $sticker->image );
            }  
            $sticker->image = $image_name;     
        }
        $sticker->save();

        $notification = [
            'message' => 'Sticker Updated Successfully!!...',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.pages.home.sticker')->with($notification);
    }
}
