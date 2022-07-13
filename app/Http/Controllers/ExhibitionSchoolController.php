<?php

namespace App\Http\Controllers;

use App\Models\Admin\ExhibitionSchool;
use Illuminate\Http\Request;

class ExhibitionSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Exhibition school";
        $data['schools'] = ExhibitionSchool::orderBy('id', 'DESC')->get();

        return view('backend.exhibition-school.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        $school = new ExhibitionSchool;
        $school->name = $request->name;
        $school->address = $request->address;
        $school->save();

        return redirect()->route('school.index')->with('message', 'New school is added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\ExhibitionSchool  $exhibitionSchool
     * @return \Illuminate\Http\Response
     */
    public function show(ExhibitionSchool $exhibitionSchool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\ExhibitionSchool  $exhibitionSchool
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Exhibition's School - Edit";
        $data['school'] = ExhibitionSchool::findOrFail(intval($id));

        return view('backend.exhibition-school.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\ExhibitionSchool  $exhibitionSchool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $school = ExhibitionSchool::findOrFail(intval($id));

        //Validate Date
        $this->validate($request, array(
            'name' => 'required|max:255',
            'address' => 'required|max:255',
        ));

        $school->name = $request->name;
        $school->address = $request->address;
        $school->save();

        return redirect()->route('school.index')->with('message', 'School has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\ExhibitionSchool  $exhibitionSchool
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = ExhibitionSchool::find(intval($id));
        $school->delete();

        return back()->with('message', 'School is deleted');
    }
}
