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

    
}
