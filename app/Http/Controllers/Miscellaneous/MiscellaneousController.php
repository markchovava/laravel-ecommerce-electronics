<?php

namespace App\Http\Controllers\Miscellaneous;

use App\Http\Controllers\Controller;
use App\Models\Miscellaneous\Miscellaneous;
use Illuminate\Http\Request;

class MiscellaneousController extends Controller
{
    public function zwl_edit(Request $request){
        $currency = Miscellaneous::where('name', 'ZWL')->first();
        if(!empty($currency)){
            $data['currency'] = $currency;
        }else{
            $data['currency'] = null;
        }
        return view('backend.currency.zwl_edit', $data);
    }

    public function zwl_store(Request $request,){
        $currency = Miscellaneous::where('name', 'ZWL')->first();
        if(!empty($currency)){    
            $currency->value = $request->zwl_amount;
            $currency->save();
        }else{
            $currency = new Miscellaneous();
            $currency->name = 'ZWL';
            $currency->value = $request->zwl_amount;
            $currency->save();
        }
        
        return redirect()->route('admin.zwl.edit');
    }
}
