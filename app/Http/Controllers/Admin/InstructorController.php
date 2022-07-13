<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Instructor;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::orderBy('id', 'ASC')->get();
        return view('backend.instructor.index', compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:instructors|max:255',
            'phone' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'bio' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,gif,png|max:8192',
        ]);

        $instructor = new Instructor;
        $instructor->first_name = $request->first_name;
        $instructor->last_name = $request->last_name;
        $instructor->email = $request->email;
        $instructor->phone = $request->phone;
        $instructor->address = $request->address;
        $instructor->bio = $request->bio;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-'.$extension;
            $file->move('uploads/images/instructor/', $filename);
            $instructor->image = $filename;
        }
        $instructor->save();
        return redirect()->route('instructor.index')->with('success', 'Instructor created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instructor = Instructor::findOrFail($id);
        return view('backend.instructor.show', compact('instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);
        return view('backend.instructor.edit', compact('instructor'));
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
        $request->validate([
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'email|unique:instructors,email,'.$id.'|max:255',
            'phone' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'bio' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,gif,png|max:8192',
        ]);

        $instructor = Instructor::findOrFail($id);
        $instructor->first_name = $request->first_name;
        $instructor->last_name = $request->last_name;
        $instructor->email = $request->email;
        $instructor->phone = $request->phone;
        $instructor->address = $request->address;
        $instructor->bio = $request->bio;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-'.$extension;
            $file->move('uploads/images/instructor/', $filename);
            $instructor->image = $filename;
        }
        $instructor->save();
        return redirect()->route('instructor.index')->with('success', 'Instructor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::delete('uploads/images/instructor/'.$id);
        $instructor = Instructor::findOrFail(intval($id));
        $instructor->delete();
        return redirect()->route('instructor.index')->with('message', 'Instructor has been deleted successfully');

        
    }
}
