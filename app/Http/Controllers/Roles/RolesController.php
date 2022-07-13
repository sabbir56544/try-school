<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /* function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','show']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Roles - Page';
        $data['roles'] = Role::paginate(10);

        return view('backend.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Roles';
        $data['permissions'] = Permission::all();

        return view('backend.roles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:roles',
            'permissions' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Permission Already Exists!');
         }else{
             $role = Role::create([
                 'name' => $request->name
             ]);

             if($request->has("permissions")){
                $role->givePermissionTo($request->permissions);
            }

             if (empty($role)) {
                 return redirect()->back()->withInput();
             }
         }

        return redirect()->route('roles.index')->with('message', 'Roles added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $data['title'] = $role->name." - Role - Edit";
        $data['role'] = $role;
        $data['permissions'] = Permission::all();

        return view('backend.roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:roles,name,'.$id
        ]);


        if ($validator->fails()) {
            return back()->with('error', 'Roles Already Exists!');
            }
         else{
            $role = Role::where('id',$id)->first();

            $role->name = $request->name;

            if ($role->update()) {
                if (!empty($request->permissions)) {
                    $role->syncPermissions($request->permissions);
                }
            }
        }

        return redirect()->route('roles.index')->with('message', 'Roles Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if(!$role->delete()){
            return back()->with('error', 'Something wen wrong');
        }

        return redirect()->route('roles.index')->with('error', 'Roles Deleted Successfully');
    }
}