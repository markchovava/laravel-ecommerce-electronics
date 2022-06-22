<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product\Product;
use App\Models\Product\ProductSerialNumber;
use App\Models\User;

class PurchaseController extends Controller
{
    public function index(){
        return view('backend.inventory.purchase.index');
    }

    public function add(){
        return view('backend.inventory.purchase.add');
    }

    public function store(Request $request){
        return view('backend.inventory.purchase.add');
    }

    public function edit($id){
        return view('backend.inventory.purchase.edit');
    }

    public function update(Request $request, $id){
        return view('backend.inventory.purchase.add');
    }

    public function view(){
        return view('backend.inventory.purchase.view');
    }

    public function search_product(Request $request){
        $product_name = $request->product_name;
        $data['product'] = Product::where('name', 'LIKE', '%' . $product_name . '%')->get();
        return response()->json($data);
    }

    public function search_supplier(Request $request){
        $supplier_name = $request->supplier_name;
        $data['supplier'] = User::where('name', 'LIKE', '%' . $supplier_name . '%')
                                    ->where('role', 'Supplier')->get();
        return response()->json($data);
    }
}
