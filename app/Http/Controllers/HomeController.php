<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:dashboard-view', ['only' => ['index']]);
    // }

    public function index()
    {
        $data['title'] = 'Dashboard';

        return view('backend.index', $data);
    }
}
