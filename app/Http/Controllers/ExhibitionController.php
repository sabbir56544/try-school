<?php

namespace App\Http\Controllers;

use App\Models\Front\Exhibition;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Exhibition";
        $data['exhibitions'] = Exhibition::orderBy('id', 'DESC')->get();

        return view('backend.exhibition.index', $data);
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
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,gif,png|max:2048',
            'start' => 'required',
            'end' => 'required',
        ]);

        $exhibition = new Exhibition;
        $exhibition->title = $request->title;
        $exhibition->start = $request->start;
        $exhibition->end = $request->end;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = time() . '-gallery' . '.' . $extension;
            $file->move('upload/images/', $filename);
            $exhibition->image = $filename;
        }
        $exhibition->save();

        return redirect()->route('exhibition.index')->with('message', 'New Exhibition is add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Front\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function show(Exhibition $exhibition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Front\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Exhibition - Edit";
        $data['exhibition'] = Exhibition::findOrFail(intval($id));

        return view('backend.exhibition.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Front\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,gif,png|max:2048',
            'start' => 'required',
            'end' => 'required',
        ]);

        $exhibition = Exhibition::findOrFail(intval($id));
        $exhibition->title = $request->title;
        $exhibition->start = $request->start;
        $exhibition->end = $request->end;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = time() . '-gallery' . '.' . $extension;
            $file->move('upload/images/', $filename);
            $exhibition->image = $filename;
        }
        $exhibition->save();

        return redirect()->route('exhibition.index')->with('message', 'Exhibition has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Front\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exhibition = Exhibition::findOrFail(intval($id));
        $image_path = '/home/mahanand/exhibitor.gainsgroup.com.bd/uploads/images/'.$exhibition->image;
        if(File::exists($image_path)){
            File::delete($image_path);
        }

        $exhibition->delete();
        return redirect()->route('exhibition.index')->with('message', 'An Exhibitor is deleted successfully');
    }
}