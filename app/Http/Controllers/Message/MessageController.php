<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Models\Message\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $data['unread'] = Message::where('status', 'Unread')->orderBy('created_at', 'desc')->get();
        $data['read'] = Message::where('status', 'Read')->orderBy('created_at', 'desc')->get();
        $data['all'] = Message::orderBy('created_at', 'desc')->get();
        return view('backend.message.index', $data);
    }

    public function unread(){
        $data['unread'] = Message::where('status', 'Unread')->orderBy('created_at', 'desc')->get();
        $data['read'] = Message::where('status', 'Read')->orderBy('created_at', 'desc')->get();
        $data['all'] = Message::orderBy('created_at', 'desc')->get();
        return view('backend.message.unread', $data);
    }

    public function read(){
        $data['unread'] = Message::where('status', 'Unread')->orderBy('created_at', 'desc')->get();
        $data['read'] = Message::where('status', 'Read')->orderBy('created_at', 'desc')->get();
        $data['all'] = Message::orderBy('created_at', 'desc')->get();
        return view('backend.message.read', $data);
    }

    public function view($id){
        $message = Message::find($id);
        $message->status = 'Read';
        $message->save();
        $data['message'] = Message::find($id);
        
        $data['unread'] = Message::where('status', 'Unread')->orderBy('created_at', 'desc')->get();
        $data['read'] = Message::where('status', 'Read')->orderBy('created_at', 'desc')->get();
        $data['all'] = Message::orderBy('created_at', 'desc')->get();
        return view('backend.message.view', $data);
    }

    public function add(){
        $data['unread'] = Message::where('status', 'Unread')->orderBy('created_at', 'desc')->get();
        $data['read'] = Message::where('status', 'Read')->orderBy('created_at', 'desc')->get();
        $data['all'] = Message::orderBy('created_at', 'desc')->get();
        return view('backend.message.add', $data);
    }

    public function delete($id){
        $message = Message::find($id);
        $message->delete();

        $notification = [
            'message' => 'Message Deleted Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.message.all')->with($notification);
    }
}
