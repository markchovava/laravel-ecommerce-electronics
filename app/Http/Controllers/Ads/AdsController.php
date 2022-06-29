<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index(){
        return view('backend.ads.index');
    }

    public function edit(){
        return view('backend.ads.edit');
    }
}
