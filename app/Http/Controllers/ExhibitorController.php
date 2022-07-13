<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\School;
use App\Models\Front\Exhibitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Front\Exhibition;
use App\Models\Group;
use App\Models\Setting;
use Illuminate\Contracts\Mail\Mailable;
use PDF;
use File;
use Carbon\Carbon;


class ExhibitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Gains School | Exhibitor's Details";
        $data['exhibitions'] = Exhibitor::orderBy('id', 'DESC')->paginate(10);

        return view('backend.exhibitor.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Gains School | Registration';
        $data['groups'] = Group::get();
        $data['countries'] = Country::get();
        $data['exhibitions'] = Exhibition::orderBy('id', 'DESC')->get();

        return view('frontend.exhibitor.form', $data);
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
            'group' => 'required',
            'name' => 'required|string|max:255',
            'phone'  => 'required|unique:exhibitors',
            'email' => 'required|string|email|max:255|unique:exhibitors',
            'country_id' => 'required',
            'school' => 'required|string|max:255',
            'b_date' => 'required',
            'b_month' => 'required',
            'b_year' => 'required',
            'art_name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'artwork' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'group.required' => 'Please select a group',
            'name.required' => 'Please insert participant name',
            'phone' => 'Please insert participant phone numer',
            'country_id.required' => 'Please select country',
            'school.required' => 'Please insert your school name',
            'art_name.required' => 'Please insert artwork name',
            'image.required' => 'Please select participant image',
            'image.max' => 'Please select a image under 2 MB',
            'artwork.max' => 'Please select a image under 2 MB',
        ]);

        $exhibitor = new Exhibitor();
        $exhibitor->exhibition_id = $request->exhibition_id;
        $exhibitor->group = $request->group;
        $exhibitor->name = $request->name;
        $exhibitor->email = $request->email;
        $exhibitor->phone = $request->phone;
        $exhibitor->b_date = $request->b_date;
        $exhibitor->b_month = $request->b_month;
        $exhibitor->b_year = $request->b_year;
        $exhibitor->country_id = $request->country_id;
        $exhibitor->school = $request->school;
        $exhibitor->art_name = $request->art_name;
        $exhibitor->media = $request->media;
        $exhibitor->size = $request->size;
        $exhibitor->year = $request->year;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = time().'-'.$extension;
            $file->move('uploads/images/', $filename);
            $exhibitor->image = $filename;
        }
        if($request->hasfile('artwork')){
            $file = $request->file('artwork');
            $extension = $file->getClientOriginalName();
            $filename = time().'-'.$extension;
            $file->move('uploads/images/', $filename);
            $exhibitor->artwork = $filename;
        }

        $exhibitor->link = $request->link;

        $exhibitor->save();
        $setting = Setting::where('id', 1)->first();

        $data = array(
            'exhibitor'  => $exhibitor,
            'setting' => $setting,
        );

        Mail::to($request->email)->send(new SendMail($data));


        return redirect()->route('exhibitor.show', $exhibitor->id)->with('success', 'Thank you for registration!! Download your copy')->with('mail', 'We sent you a mail with confirmation!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Front\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = "Gains School | Show";
        $data['setting'] = Setting::where('id', 1)->first();
        $data['exhibitor'] = Exhibitor::where('id', '=', $id)->firstOrFail();
        // dd($data['exhibitor']);

        return view('frontend.exhibitor.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Front\Exhibition  $exhibition

    * @return \Illuminate\Http\Response
     */
    public function edit(Exhibitor $Exhibitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Front\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exhibitor $Exhibitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Front\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exhibitor = Exhibitor::findOrFail(intval($id));

        $image_path = '/home/mahanand/exhibitor.gainsgroup.com.bd/uploads/images/'.$exhibitor->image;
        $artwork_path = '/home/mahanand/exhibitor.gainsgroup.com.bd/uploads/images/'.$exhibitor->artwork;
        if(File::exists($image_path)){
            File::delete($image_path);
        }

        if(File::exists($artwork_path)){
            File::delete($artwork_path);
        }

        $exhibitor->delete();
        return redirect()->route('exhibitor.index')->with('message', 'An Exhibitor is deleted successfully');
    }

    public function pdf($id)
    {
        $exhibitor = Exhibitor::with('country', 'school')->findOrFail(intval($id));
        $setting = Setting::where('id', 1)->first();

        $pdf = PDF::loadView('frontend.pdf', compact('exhibitor', 'setting'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download($exhibitor->regi_code.'-'.$exhibitor->created_at.'.pdf');

        //return view('front.pdf', compact('exhibitor', 'setting'));
    }

    public function single($id)
    {
        $data['title']= "Gains School | Participant";
        $data['exhibitor'] = Exhibitor::findOrFail(intval($id));

        return view('backend.exhibitor.show', $data);
    }
}