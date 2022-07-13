<?php

namespace App\Http\Controllers;

use App\Models\Admin\ExhibitionCategory;
use Illuminate\Http\Request;

class ExhibitionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Exhibition Category";
        $data['categories'] = ExhibitionCategory::get();

        return view('backend.exhibition-category.index', $data);
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
            'title' => 'required|max:255|unique:exhibition_categories,title',
        ]);

        $category = new ExhibitionCategory;
        $category->title = $request->title;
        $category->save();

        return back()->with('message', 'New category is added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\ExhibitionCategory  $exhibitionCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExhibitionCategory $exhibitionCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\ExhibitionCategory  $exhibitionCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Exhibition Category - Edit";
        $data['category'] = ExhibitionCategory::find(intval($id));

        return view('backend.exhibition-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\ExhibitionCategory  $exhibitionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = ExhibitionCategory::find(intval($id));
        if($request->title != $category->title){
           //Validate Date
            $this->validate($request, array(
                'title' => 'required|max:255|unique:exhibition_categories,title',
            ));
        }

        $category->title = $request->title;
        $category->save();

        return redirect()->route('category.index')->with('message', 'Category is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\ExhibitionCategory  $exhibitionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ExhibitionCategory::find(intval($id));
        $category->delete();

        return back()->with('message', 'Category is deleted');
    }
}
