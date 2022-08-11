<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::orderBy('updated_at', 'desc')->paginate(15);
        $data['roles'] = $roles;
        $data['results'] = NULL;
        return view('backend.role.index', $data);
    }
    public function search(Request $request){
        $name = $request->search;
        $results = Role::where('name', 'LIKE', $name)->get();
        $data['results'] = $results;
        $data['roles'] = NULL;
        return view('backend.role.index', $data);
    }
    public function add(){
        return view('backend.role.add');
    }

    public function store(Request $request){
        $level_id = $request->level_id;
        if( isset($level_id) ){
            $role = new Role();
            $role->name = $request->name;
            $role->description = $request->description;
            $role->level_id = $request->level_id;
            $role->updated_at = now();
            $role->save();
            /* Response Message */
            $notification = [
                'message' => 'Added Successfully!!...',
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.role')->with($notification);
        } else{
            $notification = [
                'message' => 'Level is required to save Role.',
                'alert-type' => 'warning'
            ];
            return view('backend.role.add')->with($notification);
        }  
    }

    public function view($id){
        $role = Role::where('id', $id)->first();
        $data['role'] = $role;
        return view('backend.role.view', $data);
    }
    public function edit($id){
        $role = Role::find($id);
        $data['role'] = $role;
        return view('backend.role.edit', $data);
    }
    public function update(Request $request, $id){
        $level_id = $request->level_id;
        if( isset($level_id) ){
            $role = Role::find($id);
            $role->name = $request->name;
            $role->description = $request->description;
            $role->level_id = $request->level_id;
            $role->updated_at = now();
            $role->save();
            /* Response Message */
            $notification = [
                'message' => 'Updated Successfully!!...',
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.role')->with($notification);
        } else{
            $notification = [
                'message' => 'Level is required to save Role.',
                'alert-type' => 'warning'
            ];
            return view('backend.role.edit')->with($notification);
        }  
    }

    public function delete($id){
        Role::where('id', $id)->delete();
        $notification = [
            'message' => 'Deleted Successfully.',
            'alert-type' => 'danger'
        ];
        return redirect()->route('admin.role')->with($notification);
    }
}
