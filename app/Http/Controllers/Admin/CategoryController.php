<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id', 'ASC')->get();
        return view('backend.category.index', compact('category'));
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
            'name' => 'required|min:5|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,gif,png|max:4096',
            'icon' => 'nullable|image|mimes:jpeg,jpg,gif,png|max:4096',
        ]);


        $artist = new Category;
        $artist->name = $request->name;
        $artist->slug = $this->createSlug($request->name);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-'.$extension;
            $file->move('uploads/images/category/', $filename);
            $artist->image = $filename;
        }

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $extension = $file->getClientOriginalName();
            $filename = time().'-'.$extension;
            $file->move('uploads/images/category/', $filename);
            $artist->image = $filename;
        }
        $artist->save();
        return redirect()->route('main-category.index')->with('message', 'New Category is added successfully');
        
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
    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.category.edit', compact('category'));
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
        $this->validate($request, array(
            'name' => 'required|min:5|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,gif,png|max:2048',
        ));


        $artist = Category::findOrFail(intval($id));
        $artist->name = $request->name;

        if($artist->name != $request->name){
            $artist->slug = $this->createSlug($request->name);
        }

        if ($request->hasFile('image')) {
            $image_path = public_path().'/upload/images/category'.$artist->image;
            if($artist->image){
                storage::delete($artist->image);
            }

            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = time() . '-thumbnail' . '.' . $extension;
            $file->move('uploads/images/category', $filename);
            $artist->image = $filename;
        }

        if ($request->hasFile('icon')) {
            $image_path = public_path().'/upload/images/category'.$artist->icon;
            if($artist->image){
                storage::delete($artist->icon);
            }

            $file = $request->file('icon');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = time() . '-thumbnail' . '.' . $extension;
            $file->move('uploads/images/category', $filename);
            $artist->image = $filename;
        }

        $artist->save();
        return redirect()->route('main-category.index')->with('message', 'Category has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::delete('uploads/images/category/'.$id);
        $category = Category::findOrFail(intval($id));
        $category->delete();
        return redirect()->route('main-category.index')->with('message', 'Category has been deleted successfully');


        
    }

    /**
     * Create a slug from name
     * @param  string $name
     * @return string $slug
     */
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
        $slug = str::slug($name, $separator = "-", app()->getLocale());
        return Category::select()->where('slug', 'like', $slug)->count();
    }
}
