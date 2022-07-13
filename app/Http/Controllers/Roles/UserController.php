<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /* function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    } */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'User Management';
        $data['users'] = User::paginate(10);
        $data['roles'] = Role::all();

        return view('backend.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create User';
        $data['roles'] = Role::all();

        return view('backend.users.create', $data);
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
            'role' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'User Already Exists!');
         }
         else{

            $user = User::create([
                'role' => Str::slug($request->role),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => $request->file('image') ? $request->file('image')->store('images/users') : NULL,
                'status' => $request->status,
            ]);

            $user->assignRole($request->role);
        }

        if (empty($user)) {
            return redirect()->back()->withInput();
        }

        return redirect()->route('users.index')->with('message', 'User added Successfully');
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
    public function edit(User $user)
    {
        $data['title'] = $user->name." - User - Edit";
        $data['user'] = $user;
        $data['roles'] = Role::all();

        return view('backend.users.edit', $data);
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
            'role' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable',
            'image' => 'nullable|mimes:jpg,png,jpeg',
            'status' => 'required',
        ]);


        if ($validator->fails()) {
            return back()->with('error', 'User Already Exists!');
         }
         else{

            $user = User::where('id',$id)->first();

            $path = $user->image;

            if($request->hasFile('image')){
                Storage::delete($user->image);
                $path = $request->file('image')->store('images/users');
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->role = Str::slug($request->roles);
            $user->email = $request->email;
            $user->password = $request->password;
            $user->status = $request->status;
            $user->image = $path;

            if($user->update()){
                if ($request->roles) {
                    $user->roles()->detach();
                    $user->assignRole($request->roles);
                }

                return redirect()->route("users.index")->with('message', 'User Updated Successfully');
            }

        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->image){
            Storage::delete($user->image);
        }

        if(!$user->delete()){
            return back()->with('error', 'Something wen wrong');
        }

        return back()->with('error', 'User Deleted Successfully');
    }
}