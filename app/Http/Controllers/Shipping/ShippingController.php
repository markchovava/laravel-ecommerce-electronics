<?php

namespace App\Http\Controllers\Shipping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shipping\Shipping;

class ShippingController extends Controller
{
    public function edit(){
        $data['shipping'] = Shipping::first();
        return view('backend.shipping.edit', $data);
    }

    public function update(Request $request){
        $shipping = Shipping::first();
        if( !empty($shipping) ){
            $shipping->fee = $request->shipping_fee;
            $shipping->city = $request->shipping_city;
            $shipping->quantity = $request->shipping_quantity;
            $shipping->save();
        } else{
            $shipping = new Shipping();
            $shipping->fee = $request->shipping_fee;
            $shipping->city = $request->shipping_city;
            $shipping->quantity = $request->shipping_quantity;
            $shipping->save();
        }

        $notification = [
            'message' => 'Shipping updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.shipping')->with($notification);
    }
}
