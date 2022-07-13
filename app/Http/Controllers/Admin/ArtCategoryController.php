<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\ArtCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ArtCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Art-Categories";
        $data['categories'] = ArtCategory::orderBy('id', 'ASC')->get();

        return view('backend.art-category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Create Art-Categories";

        return view('backend.art-category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\ArtCategory  $artCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ArtCategory $artCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\ArtCategory  $artCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Edit Art-Categories";
        $data['category'] = ArtCategory::findOrFail(intval($id));

        return view('backend.art-category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\ArtCategory  $artCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = ArtCategory::findOrFail(intval($id));
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,gif,png|max:2048',
            'description' => 'required|string',
        ]);
        
        $category->name = $request->name;
        if($category->name != $request->name){
            $category->slug = $this->createSlug($request->name);
        }

        $category->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
            $fileName = time() . '-category' . '.' . $extension;
            Image::make($file)->resize(357, 175)->save('uploads/images/' . $fileName);
            $category->image = $fileName;
        }

        $category->save();
        return redirect()->route('art-categories.index')->with('message', 'Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\ArtCategory  $artCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArtCategory $artCategory)
    {
        //
    }

    protected function createSlug(string $name): string
    {
        $slugsFound = $this->getSlugs($name);
        $counter = 0;
        $counter += $slugsFound;
        $slug = str::slug($name, $separator = "-", app()->getLocale());
        if ($counter) {
            $slug = $slug . '-' . $counter;
        }

        return $slug;
    }

    /**
     * Find same listing with same name
     * @param  string $name
     * @return int $total
     */
    protected function getSlugs($name): int
    {
        return ArtCategory::select()->where('name', 'like', $name)->count();
    }
}
