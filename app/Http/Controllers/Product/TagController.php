<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Tag\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::orderby('updated_at', 'desc')->paginate(15);
        $data['tags'] = isset($tags) ? $tags : NULL;
        $data['results'] = NULL;
        $data['search'] = NULL;
        /*  */
        return view('backend.tag.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = Tag::where('title', 'LIKE', '%' . $search . '%')
                        ->orderby('updated_at', 'desc')
                        ->paginate(15);
        $data['results'] = isset($results) ? $results : NULL;
        $data['tags'] = NULL;
        $data['search'] = $search;
        /*  */
        return view('backend.tag.index', $data);
    }

    public function add(){
        return view('backend.tag.add');
    }

    public function store(Request $request){
        $tag = new Tag();
        $tag->title = $request->tag_title;
        $tag->subtitle = $request->tag_subtitle;
        $tag->click_name = $request->tag_click_name;
        $tag->amount = $request->tag_amount;
        $tag->percent = $request->tag_percent;
        $tag->slug = $request->tag_slug;
        $tag->position = $request->tag_position;
        $tag->status = $request->tag_status;
        $tag->created_at = now();
        if( $request->file('tag_image') )
        {
            $tag_thumbnail = $request->file('tag_image');
            $image_extension = strtolower($tag_thumbnail->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/tags/';
            $tag_thumbnail->move($upload_location, $image_name);
            if($tag->image)
            {
                unlink( $upload_location . $tag->image );
            }  
            $tag->image = $image_name;     
        }
        $tag->save();

        $notification = [
            'message' => 'Tag Added Successfully!!...',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.tag')->with($notification);
    }

    public function edit($id){
        $data['tag'] = Tag::find($id);
        return view('backend.tag.edit', $data);
    }

    public function update(Request $request, $id){
        $tag = Tag::find($id);
        $tag->title = $request->tag_title;
        $tag->subtitle = $request->tag_subtitle;
        $tag->click_name = $request->tag_click_name;
        $tag->amount = $request->tag_amount;
        $tag->percent = $request->tag_percent;
        $tag->slug = $request->tag_slug;
        $tag->position = $request->tag_position;
        $tag->status = $request->tag_status;
        $tag->updated_at = now();
        if( $request->file('tag_image') )
        {
            $tag_thumbnail = $request->file('tag_image');
            $image_extension = strtolower($tag_thumbnail->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/tags/';
            $tag_thumbnail->move($upload_location, $image_name);
            if($tag->image)
            {
                unlink( $upload_location . $tag->image );
            }  
            $tag->image = $image_name;     
        }
        $tag->save();

        $notification = [
            'message' => 'Tag Updated Successfully!!...',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.tag')->with($notification);
    }
    
}
