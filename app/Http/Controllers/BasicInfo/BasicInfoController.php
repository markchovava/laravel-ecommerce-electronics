<?php

namespace App\Http\Controllers\BasicInfo;

use App\Http\Controllers\Controller;
use App\Models\Backend\BasicInfo;
use Illuminate\Http\Request;

class BasicInfoController extends Controller
{
    public function edit()
    {
        $data['info'] = BasicInfo::first();
        return view('backend.basic_info.edit', $data);
    }

    public function update(Request $request){
        $first = BasicInfo::first();
        if(!empty($first)){
            $first_id = $first->id;
            $basic_info = BasicInfo::find($first_id);
            $basic_info->company_logo = $request->company_logo;
            $basic_info->company_name = $request->company_name;
            $basic_info->company_phone_number = $request->company_phone_number;
            $basic_info->company_email = $request->company_email;
            $basic_info->company_address = $request->company_address;
            $basic_info->save();
        }else{
            $basic_info = new BasicInfo();
            $basic_info->company_logo = $request->company_logo;
            $basic_info->company_name = $request->company_name;
            $basic_info->company_phone_number = $request->company_phone_number;
            $basic_info->company_email = $request->company_email;
            $basic_info->company_address = $request->company_address;
            $basic_info->save();
        }
        return redirect()->route('admin.info');
    }

    public function view()
    {
        $data['info'] = BasicInfo::first();
        return view('backend.basic_info.edit', $data);
    }
}
