<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /* function __construct()
    {
         $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','show']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    } */

    public function index()
    {
        $data['title'] = 'Permissions';
        $data['permissions'] = Permission::all();

        return view('backend.permissions.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Create Permissions';

        return view('backend.permissions.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions',
            'group_name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Permission Already Exists!');
         }else{
             $permission = Permission::create([
                 'name' => Str::slug($request->name),
                 'group_name' => $request->group_name
             ]);
         }

        if (empty($permission)) {
            return redirect()->back()->withInput();
        }

        return redirect()->route('permissions.index')->with('message', 'Permissions added Successfully');
    }

    public function edit(Permission $permission)
    {
        $data['title'] = $permission->name." - Permission - Edit";
        $data['permission'] = $permission;

        return view('backend.permissions.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions,name,'.$id,
            'group_name' => 'required'
        ]);


        if ($validator->fails()) {
            return back()->with('error', 'Permission Already Exists!');
            }
         else{
            $permission = Permission::where('id',$id)->first();

            $permission->name = Str::slug($request->name);
            $permission->group_name = $request->group_name;

            if (!$permission->update()) {
                return redirect()->back()->withInput();
            }
        }

        return redirect()->route('permissions.index')->with('message', 'Permissions Updated Successfully');
    }

    public function destroy(Permission $permission)
    {
        if(!$permission->delete()){
            return back()->with('error', 'Something wen wrong');
        }

        return redirect()->route('permissions.index')->with('error', 'Permissions Deleted Successfully');
    }
}