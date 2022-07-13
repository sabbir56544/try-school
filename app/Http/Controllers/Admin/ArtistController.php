<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Artist';
        $data['artists'] = Artist::orderBy('id', 'ASC')->get();

        return view('backend.artist.index', $data);
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
            'image' => 'required|image|mimes:jpeg,jpg,gif,png|max:2048',
        ]);


        $artist = new Artist;
        $artist->name = $request->name;
        $artist->slug = $this->createSlug($request->name);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-'.$extension;
            $file->move('uploads/images/', $filename);
            $artist->image = $filename;
        }

        $artist->save();

        return redirect()->route('artist.index')->with('message', 'New Artist is added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Artist - Edit";
        $data['artist'] = Artist::findOrFail(intval($id));

        return view('backend.artist.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|min:5|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,gif,png|max:2048',
        ));


        $artist = Artist::findOrFail(intval($id));
        $artist->name = $request->name;

        if($artist->name != $request->name){
            $artist->slug = $this->createSlug($request->name);
        }

        if ($request->hasFile('image')) {
            $image_path = public_path().'/upload/images/'.$artist->image;
            if($artist->image){
                storage::delete($artist->image);
            }

            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = time() . '-thumbnail' . '.' . $extension;
            $file->move('uploads/images/', $filename);
            $artist->image = $filename;
        }

        $artist->save();

        return redirect()->route('artist.index')->with('message', 'Artist has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        Storage::delete($artist->image);
        if($artist->delete()) {
            return redirect()->back()->with('message', 'Artist has been deleted successfully');
        }
        return redirect()->back()->with('error', 'Failed to delete todo');
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
        return Artist::select()->where('slug', 'like', $slug)->count();
    }
}