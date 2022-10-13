<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product\Sales;

class SalesController extends Controller
{
    public function index(){
        $data['sales'] = Sales::latest()->paginate(15);
        return view('', $data);
    }
}
