<?php

namespace App\Http\Controllers\Pages\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StickerController extends Controller
{
    public function index(){
        return view('backend.pages.home.sticker.index');
    }

    public function add(){
        return view('backend.pages.home.sticker.add');
    }
}
