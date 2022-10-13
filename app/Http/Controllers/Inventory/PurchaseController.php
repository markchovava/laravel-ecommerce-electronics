<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Purchase;
use App\Models\Inventory\Supplier;
use Illuminate\Http\Request;

use App\Models\Product\Product;
use App\Models\Product\ProductSerialNumber;
use App\Models\User;

class PurchaseController extends Controller
{
    public function index(){
        $data['purchases'] = Purchase::with(['product', 'supplier'])->paginate(15);
        return view('backend.inventory.purchase.index', $data);
    }

    public function add(){
        return view('backend.inventory.purchase.add');
    }

    public function store(Request $request){
        $supplier = new Supplier();
        $supplier->name = $request->supplier_name;
        $supplier->email = $request->supplier_email;
        $supplier->phone_number = $request->supplier_phone_number;
        $supplier->address = $request->supplier_address;
        $supplier->save();

        $purchase = new Purchase();
        $purchase->supplier_id = $supplier->id;
        $purchase->product_name = $request->product_name;
        $purchase->quantity = $request->product_quantity;
        $purchase->cost = $request->product_cost;
        $purchase->notes = $request->product_notes;
        $purchase->status = $request->product_status;
        $purchase->created_at = now();
        $purchase->save();

        $notification = [
            'message' => 'Purchase saved Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('inventory.purchase')->with($notification);

    }
    
    public function view($id){
        $data['purchase'] = Purchase::with(['product', 'supplier'])->find($id);
        $supplier_id = $data['purchase']->supplier_id;
        $data['supplier'] = Supplier::where('id', $supplier_id)->first();
        return view('backend.inventory.purchase.view', $data);
    }

    public function edit($id){
        $data['purchase'] = Purchase::with(['product', 'supplier'])->find($id);
        $supplier_id = $data['purchase']->supplier_id;
        $data['supplier'] = Supplier::where('id', $supplier_id)->first();
        return view('backend.inventory.purchase.edit', $data);
    }

    public function update(Request $request, $id){
        $purchase = Purchase::find($id);
        $purchase->product_name = $request->product_name;
        $purchase->quantity = $request->product_quantity;
        $purchase->cost = $request->product_cost;
        $purchase->notes = $request->product_notes;
        $purchase->status = $request->product_status;
        //$purchase->created_at = now();
        $purchase->save();

        $supplier = Supplier::find($purchase->supplier_id);
        $supplier->name = $request->supplier_name;
        $supplier->email = $request->supplier_email;
        $supplier->phone_number = $request->supplier_phone_number;
        $supplier->address = $request->supplier_address;
        $supplier->save();

        $notification = [
            'message' => 'Purchase updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('inventory.purchase')->with($notification);
    }

    public function search_product(Request $request){
        $product_name = $request->product_name;
        $data['product'] = Product::where('name', 'LIKE', '%' . $product_name . '%')->get();
        return response()->json($data);
    }

    public function search_supplier(Request $request){
        $supplier_name = $request->supplier_name;
        $data['supplier'] = Supplier::where('name', 'LIKE', '%' . $supplier_name . '%')->get();
        return response()->json($data);
    }

    public function delete($id){
        $purchase = Purchase::find($id);
        $purchase->delete();
        $notification = [
            'message' => 'Purchase Deleted Successfully!!...',
            'alert-type' => 'danger'
        ];
        return redirect()->route('inventory.purchase')->with($notification);
    }
}
